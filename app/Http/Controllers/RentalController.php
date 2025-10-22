<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalItem;
use App\Models\Product;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Create rental from cart
     */
    public function create(Request $request)
    {
        // Get cart items from session
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Keranjang kosong');
        }

        return view('rentals.create', compact('cart'));
    }

    /**
     * Process checkout
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'rental_start_date' => 'required|date|after:today',
            'rental_end_date' => 'required|date|after:rental_start_date',
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
        ]);

        // Get cart items
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Keranjang kosong');
        }

        // Calculate rental days
        $startDate = \Carbon\Carbon::parse($validated['rental_start_date']);
        $endDate = \Carbon\Carbon::parse($validated['rental_end_date']);
        $totalDays = $startDate->diffInDays($endDate);

        // Calculate total price
        $subtotal = 0;
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            $subtotal += ($product->daily_rental_price * $totalDays * $item['quantity']);
        }

        // Create rental
        $rental = new Rental();
        $rental->user_id = auth()->id();
        $rental->rental_number = $rental->generateRentalNumber();
        $rental->rental_start_date = $validated['rental_start_date'];
        $rental->rental_end_date = $validated['rental_end_date'];
        $rental->total_rental_days = $totalDays;
        $rental->subtotal = $subtotal;
        $rental->total_price = $subtotal;
        $rental->customer_name = $validated['customer_name'];
        $rental->customer_email = auth()->user()->email;
        $rental->customer_phone = $validated['customer_phone'];
        $rental->customer_address = $validated['customer_address'];
        $rental->save();

        // Create rental items
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            RentalItem::create([
                'rental_id' => $rental->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'daily_price' => $product->daily_rental_price,
                'subtotal' => $product->daily_rental_price * $totalDays * $item['quantity'],
                'size' => $item['size'] ?? null,
                'special_request' => $item['special_request'] ?? null,
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('payment.show', $rental->rental_number)
            ->with('success', 'Penyewaan berhasil dibuat. Silakan lakukan pembayaran');
    }

    /**
     * Show customer's rentals
     */
    public function myRentals()
    {
        $rentals = auth()->user()->rentals()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    /**
     * Show rental detail
     */
    public function show($rental_number)
    {
        $rental = Rental::where('rental_number', $rental_number)->firstOrFail();

        // Check authorization
        if ($rental->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Akses tidak diizinkan');
        }

        return view('rentals.show', compact('rental'));
    }
}
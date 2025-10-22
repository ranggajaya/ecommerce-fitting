<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show payment form
     */
    public function show($rental_number)
    {
        $rental = Rental::where('rental_number', $rental_number)->firstOrFail();

        // Check authorization
        if ($rental->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'Akses tidak diizinkan');
        }

        $remainingAmount = $rental->total_price - $rental->payments()->sum('amount');

        return view('payments.show', compact('rental', 'remainingAmount'));
    }

    /**
     * Process payment
     */
    public function store(Request $request, $rental_number)
    {
        $rental = Rental::where('rental_number', $rental_number)->firstOrFail();

        // Check authorization
        if ($rental->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'Akses tidak diizinkan');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,e-wallet,credit_card',
            'reference_number' => 'nullable|string',
        ]);

        $remainingAmount = $rental->total_price - $rental->payments()->sum('amount');

        if ($validated['amount'] > $remainingAmount) {
            return back()->with('error', 'Jumlah pembayaran melebihi sisa yang harus dibayar');
        }

        // Create payment
        $payment = new Payment();
        $payment->rental_id = $rental->id;
        $payment->payment_number = 'PAY-' . now()->format('Ymd') . '-' . str_pad(Payment::count() + 1, 4, '0', STR_PAD_LEFT);
        $payment->amount = $validated['amount'];
        $payment->payment_method = $validated['payment_method'];
        $payment->reference_number = $validated['reference_number'];
        $payment->status = 'completed';
        $payment->payment_date = now();
        $payment->save();

        // Update rental payment status
        $totalPaid = $rental->payments()->sum('amount');
        if ($totalPaid >= $rental->total_price) {
            $rental->payment_status = 'paid';
        } elseif ($totalPaid > 0) {
            $rental->payment_status = 'partial';
        }
        $rental->save();

        return redirect()->route('rentals.show', $rental->rental_number)
            ->with('success', 'Pembayaran berhasil diproses');
    }
}

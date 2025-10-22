<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('user')->paginate(10);
        return view('admin.rentals.index', compact('rentals'));
    }

    public function show(Rental $rental)
    {
        $rental->load('items.product', 'payments');
        return view('admin.rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        return view('admin.rentals.edit', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,ready_to_pickup,picked_up,returned,cancelled',
        ]);

        $rental->update($validated);

        return redirect()->route('admin.rentals.show', $rental->id)
            ->with('success', 'Status penyewaan berhasil diperbarui');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->route('admin.rentals.index')
            ->with('success', 'Penyewaan berhasil dihapus');
    }
}

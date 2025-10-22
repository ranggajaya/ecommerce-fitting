<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $totalRentals = Rental::count();
        $totalProducts = Product::count();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $pendingRentals = Rental::where('status', 'pending')->count();

        $recentRentals = Rental::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentPayments = Payment::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRentals',
            'totalProducts',
            'totalRevenue',
            'pendingRentals',
            'recentRentals',
            'recentPayments'
        ));
    }
}
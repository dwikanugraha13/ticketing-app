<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Kategori;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard overview (stats + recent events).
     */
    public function index()
    {
        $totalEvents = Event::count();
        $totalKategori = Kategori::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_harga');

        $upcomingCount = Event::upcoming()->count();
        $ongoingCount = Event::ongoing()->count();
        $completedCount = Event::completed()->count();

        $recentEvents = Event::with('kategori')
            ->latest('created_at')
            ->take(5)
            ->get();

        $topCategories = Kategori::withCount('events')
            ->orderByDesc('events_count')
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalEvents',
            'totalKategori',
            'totalOrders',
            'totalRevenue',
            'upcomingCount',
            'ongoingCount',
            'completedCount',
            'recentEvents',
            'topCategories'
        ));
    }
}

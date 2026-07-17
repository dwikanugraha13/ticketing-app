<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Event;
use App\Models\Order;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Process checkout form from event detail page
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'tiket_id' => 'required|exists:tikets,id',
            'qty' => 'required|integer|min:1'
        ]);

        $event = Event::findOrFail($request->event_id);
        $tiket = Tiket::findOrFail($request->tiket_id);
        $qty = $request->qty;

        // Validasi stok
        if ($tiket->stok !== null && $tiket->stok < $qty) {
            return back()->with('error', 'Stok tiket tidak mencukupi.');
        }

        $totalHarga = $tiket->harga * $qty;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'order_date' => now(),
                'total_harga' => $totalHarga,
                'status' => 'pending'
            ]);

            DetailOrder::create([
                'order_id' => $order->id,
                'tiket_id' => $tiket->id,
                'jumlah' => $qty,
                'subtotal_harga' => $totalHarga
            ]);

            DB::commit();

            return redirect()->route('transactions.payment', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }

    /**
     * Show mock payment page
     */
    public function payment(Order $order)
    {
        // Pastikan hanya pemilik order yang bisa melihat
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Kalau sudah dibayar, redirect ke history
        if ($order->status === 'paid') {
            return redirect()->route('transactions.history')->with('success', 'Order sudah dibayar sebelumnya.');
        }

        $order->load(['events', 'detailOrders.tiket']);

        return view('pages.transactions.payment', compact('order'));
    }

    /**
     * Process mock payment
     */
    public function processPayment(Order $order, Request $request)
    {
        if ($order->user_id !== auth()->id()) {
            if ($request->wantsJson()) return response()->json(['error' => 'Unauthorized'], 403);
            abort(403);
        }

        if ($order->status === 'paid') {
            if ($request->wantsJson()) return response()->json(['success' => true, 'message' => 'Order sudah berstatus Paid.']);
            return redirect()->route('transactions.history')->with('error', 'Order sudah berstatus Paid.');
        }

        DB::beginTransaction();
        try {
            // Ubah status
            $order->update(['status' => 'paid']);

            // Kurangi stok tiket
            foreach ($order->detailOrders as $detail) {
                $tiket = $detail->tiket;
                if ($tiket->stok !== null) {
                    $tiket->decrement('stok', $detail->jumlah);
                }
            }

            DB::commit();
            
            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Pembayaran berhasil!']);
            }
            return redirect()->route('transactions.history')->with('success', 'Pembayaran berhasil! Tiket Anda telah diterbitkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Gagal memproses pembayaran.'], 500);
            }
            return back()->with('error', 'Gagal memproses pembayaran.');
        }
    }

    /**
     * Show transaction history for the logged in user
     */
    public function history()
    {
        $orders = Order::with(['events.lokasi', 'detailOrders.tiket'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.transactions.history', compact('orders'));
    }

    /**
     * Show all transactions for Admin
     */
    public function adminIndex()
    {
        // Admin middleware handles authorization
        $orders = Order::with(['events', 'user', 'detailOrders.tiket'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.transactions', compact('orders'));
    }
}

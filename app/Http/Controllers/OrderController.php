<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request; // JANGAN LUPA IMPORT INI
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $total = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('customer.orders.checkout', compact('cart', 'total'));
    }

    // ⚡ METHOD BARU UNTUK PROCESS CHECKOUT ⚡
    public function process(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|in:bank_transfer,e_wallet,cod',
            'notes' => 'nullable|string|max:500'
        ]);

        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $total = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

        // create order dengan semua data yang diperlukan
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
            'shipping_address' => $validated['shipping_address'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null
        ]);

        // copy cart items to order items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // clear cart
        $cart->items()->delete();

        return redirect()->route('customer.orders.index')
            ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $order->order_number);
    }

    // Method store sebagai alias untuk REST
    public function store(Request $request)
    {
        return $this->process($request);
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('customer.orders.index', compact('orders'));
    }
}

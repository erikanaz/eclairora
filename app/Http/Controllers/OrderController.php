<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function chekout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        return view('checkout', compact('cart'));
    }

    public function processOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total'   => collect($cart)->sum(fn($item) => $item['price'] * $item['qty'])
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $id,
                'qty'       => $item['qty'],
                'price'     => $item['price']
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', 'Order placed!');
    }
}

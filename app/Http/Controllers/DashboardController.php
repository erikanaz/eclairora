<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Total produk aktif
        $totalProducts = Product::count();
        
        // Cart count - cek apakah user login atau guest
        $cartCount = $this->getCartCount();
        
        // Order count (sementara 0, bisa diupdate jika ada model Order)
        $orderCount = 0;
        
        // Produk unggulan (3 produk terbaru)
        $featuredProducts = Product::with('category')
            ->latest()
            ->limit(3)
            ->get();
        
        // Kategori untuk filter (optional)
        $categories = Category::all();
        
        // Produk populer (contoh: 4 produk pertama)
        $popularProducts = Product::with('category')
            ->limit(4)
            ->get();
        
        return view('customer.dashboard', compact(
            'totalProducts',
            'cartCount',
            'orderCount',
            'featuredProducts',
            'categories',
            'popularProducts'
        ));
    }
    
    /**
     * Get cart count based on user authentication
     */
    private function getCartCount()
    {
        $cartCount = 0;
        
        if (Auth::check()) {
            // User login: check database
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cartCount = $cart->items()->sum('quantity');
            }
        } else {
            // Guest: check session
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $item) {
                $cartCount += $item['quantity'];
            }
        }
        
        return $cartCount;
    }
    
    /**
     * Get user statistics (optional)
     */
    public function getStats()
    {
        // Jika ingin API endpoint untuk stats
        $stats = [
            'total_products' => Product::count(),
            'cart_count' => $this->getCartCount(),
            'order_count' => 0,
            'featured_count' => Product::latest()->limit(3)->count(),
        ];
        
        return response()->json($stats);
    }
}
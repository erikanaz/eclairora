<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Tampilkan halaman cart
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cartItems = $cart->items()->with('product:id,name,price,image')->get();
        
        return view('customer.cart', compact('cart', 'cartItems'));
    }
    
    // ⚡ OPTIMIZED: Tambah item ke cart - VERSI CEPAT
    public function add($productId)
    {
        try {
            DB::beginTransaction();
            
            // 1. Cari product hanya kolom yang diperlukan
            $product = Product::select('id', 'name')->find($productId);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404);
            }
            
            // 2. Cari atau buat cart dengan cara SIMPLE
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['user_id' => Auth::id()]
            );
            
            // 3. Cari item dengan query langsung (tanpa eager loading)
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();
            
            if ($cartItem) {
                // Update quantity
                $cartItem->increment('quantity');
            } else {
                // Tambah item baru
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'quantity' => 1
                ]);
            }
            
            DB::commit();
            
            // 4. Hitung total items dengan cara CEPAT
            $totalItems = CartItem::where('cart_id', $cart->id)->sum('quantity');
            
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'cart_count' => $totalItems,
                'product_name' => $product->name
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk'
            ], 500);
        }
    }
    
    // Update quantity item
    public function update(Request $request, $itemId)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1|max:99'
            ]);
            
            $cartItem = CartItem::findOrFail($itemId);
            
            // Pastikan item milik user yang login
            if ($cartItem->cart->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Unauthorized'
                ], 403);
            }
            
            $cartItem->update(['quantity' => $request->quantity]);
            
            // Hitung ulang dengan cepat
            $totalItems = CartItem::where('cart_id', $cartItem->cart_id)->sum('quantity');
            $totalPrice = $cartItem->cart->items()->with('product:id,price')->get()
                ->sum(function($item) {
                    return $item->quantity * $item->product->price;
                });
            
            return response()->json([
                'success' => true,
                'message' => 'Jumlah produk diperbarui',
                'subtotal' => number_format($cartItem->quantity * $cartItem->product->price, 0, ',', '.'),
                'total_items' => $totalItems,
                'total_price' => number_format($totalPrice, 0, ',', '.')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui jumlah: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Hapus item dari cart
    public function remove($itemId)
    {
        try {
            $cartItem = CartItem::findOrFail($itemId);
            
            // Pastikan item milik user yang login
            if ($cartItem->cart->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Unauthorized'
                ], 403);
            }
            
            $cartId = $cartItem->cart_id;
            $cartItem->delete();
            
            // Hitung ulang dengan cepat
            $totalItems = CartItem::where('cart_id', $cartId)->sum('quantity');
            $totalPrice = Cart::find($cartId)->items()->with('product:id,price')->get()
                ->sum(function($item) {
                    return $item->quantity * $item->product->price;
                });
            
            return response()->json([
                'success' => true,
                'message' => 'Produk dihapus dari keranjang',
                'total_items' => $totalItems,
                'total_price' => number_format($totalPrice, 0, ',', '.')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus produk: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Kosongkan cart
    public function clear()
    {
        try {
            $cart = Cart::where('user_id', Auth::id())->first();
            
            if ($cart) {
                CartItem::where('cart_id', $cart->id)->delete();
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan',
                'total_items' => 0,
                'total_price' => 0
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengosongkan keranjang: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Get cart count (untuk AJAX)
    public function getCount()
    {
        try {
            $cart = Cart::where('user_id', Auth::id())->first();
            $count = $cart ? CartItem::where('cart_id', $cart->id)->sum('quantity') : 0;
            
            return response()->json([
                'success' => true,
                'count' => $count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'count' => 0
            ]);
        }
    }
    
    // ⚡ OPTIMIZED: Helper untuk mendapatkan atau membuat cart
    private function getOrCreateCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }
        
        // Hanya load data yang diperlukan
        return $cart->load(['items' => function($query) {
            $query->select('id', 'cart_id', 'product_id', 'quantity')
                  ->with(['product' => function($q) {
                      $q->select('id', 'name', 'price', 'image');
                  }]);
        }]);
    }
    
    // Optional: Fungsi cek stok
    private function checkStock(Product $product, $requestedQuantity = 1)
    {
        if (isset($product->stock) && $product->stock < $requestedQuantity) {
            throw new \Exception('Stok produk tidak mencukupi. Stok tersisa: ' . $product->stock);
        }
    }
}
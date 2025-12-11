<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::with('category');
        
        // Filter berdasarkan kategori
        if (request()->has('category')) {
            $query->where('category_id', request('category'));
        }
        
        // Filter berdasarkan pencarian
        if (request()->has('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Sort berdasarkan pilihan
        switch (request('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        // TANPA pagination, ambil semua data
        $products = $query->get();
        $categories = Category::all();
        
        return view('customer.products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->limit(4)
                                 ->get();
        
        return view('customer.products.show', compact('product', 'relatedProducts'));
    }
}
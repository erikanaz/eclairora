@php
    use App\Services\SupabaseService;
    $supabase = new SupabaseService();
@endphp

<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 md:px-10 py-8">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-rose-gold text-white flex items-center justify-center mr-2">
                        1
                    </div>
                    <span class="text-rose-gold font-semibold">Keranjang</span>
                </div>
                <div class="flex-1 h-1 bg-rose-gold mx-2"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-rose-gold text-white flex items-center justify-center mr-2">
                        2
                    </div>
                    <span class="text-rose-gold font-semibold">Checkout</span>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center mr-2">
                        3
                    </div>
                    <span class="text-gray-500">Selesai</span>
                </div>
            </div>
        </div>
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="font-serif text-3xl md:text-4xl text-rose-gold mb-4">Checkout</h1>
            <p class="text-lg text-cocoa-brown">Lengkapi informasi pengiriman dan pembayaran</p>
        </div>
        
        <form action="{{ route('customer.orders.process') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column: Form -->
                <div>
                    <!-- Shipping Information -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                        <h2 class="font-serif text-xl text-cocoa-brown mb-4">Informasi Pengiriman</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-dark-cocoa mb-2">Alamat Pengiriman *</label>
                                <textarea name="shipping_address" 
                                          rows="3"
                                          class="w-full px-4 py-3 bg-cream-pastel border border-rose-gold/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-gold/50 focus:border-transparent"
                                          placeholder="Masukkan alamat lengkap pengiriman"
                                          required>{{ Auth::user()->address ?? '' }}</textarea>
                            </div>
                            
                            <div>
                                <label class="block text-dark-cocoa mb-2">Catatan (Opsional)</label>
                                <textarea name="notes" 
                                          rows="2"
                                          class="w-full px-4 py-3 bg-cream-pastel border border-rose-gold/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-gold/50 focus:border-transparent"
                                          placeholder="Catatan tambahan..."></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="font-serif text-xl text-cocoa-brown mb-4">Metode Pembayaran</h2>
                        
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border border-cream-pastel rounded-xl cursor-pointer hover:bg-cream-pastel/50 transition-colors">
                                <input type="radio" name="payment_method" value="bank_transfer" class="mr-3" checked>
                                <div>
                                    <div class="font-medium text-cocoa-brown">Transfer Bank</div>
                                    <div class="text-sm text-dark-cocoa">BCA, Mandiri, BRI, BNI</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border border-cream-pastel rounded-xl cursor-pointer hover:bg-cream-pastel/50 transition-colors">
                                <input type="radio" name="payment_method" value="e_wallet" class="mr-3">
                                <div>
                                    <div class="font-medium text-cocoa-brown">E-Wallet</div>
                                    <div class="text-sm text-dark-cocoa">OVO, GoPay, Dana, ShopeePay</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border border-cream-pastel rounded-xl cursor-pointer hover:bg-cream-pastel/50 transition-colors">
                                <input type="radio" name="payment_method" value="cod" class="mr-3">
                                <div>
                                    <div class="font-medium text-cocoa-brown">Cash on Delivery (COD)</div>
                                    <div class="text-sm text-dark-cocoa">Bayar saat barang diterima</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Order Summary -->
                <div>
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                        <h2 class="font-serif text-xl text-cocoa-brown mb-6">Ringkasan Pesanan</h2>
                        
                        <!-- Daftar Produk -->
                        <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                            @foreach($cart->items as $item)
                            <div class="flex items-center">
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ $item->product->image ? $supabase->getPublicUrl($item->product->image) : asset('images/default-pastry.png') }}" 
                                         alt="{{ $item->product->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-medium text-cocoa-brown">{{ $item->product->name }}</h3>
                                    <div class="flex justify-between text-sm text-dark-cocoa">
                                        <span>{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                        <span class="font-semibold">Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Detail Harga -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-dark-cocoa">Subtotal</span>
                                <span class="text-cocoa-brown font-semibold">
                                    Rp {{ number_format($cart->totalPrice(), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-dark-cocoa">Biaya Pengiriman</span>
                                <span class="text-cocoa-brown font-semibold">Rp 15.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-dark-cocoa">Pajak (10%)</span>
                                <span class="text-cocoa-brown font-semibold">
                                    Rp {{ number_format($cart->totalPrice() * 0.1, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="border-t border-cream-pastel pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-cocoa-brown">Total</span>
                                    <span class="text-xl font-bold text-rose-gold">
                                        @php
                                            $total = $cart->totalPrice() + 15000 + ($cart->totalPrice() * 0.1);
                                        @endphp
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <button type="submit" 
                                    class="w-full text-center px-6 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 shadow-lg hover:shadow-xl">
                                Buat Pesanan
                            </button>
                            
                            <a href="{{ route('customer.cart') }}" 
                               class="block w-full text-center px-6 py-3 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300">
                                Kembali ke Keranjang
                            </a>
                        </div>
                        
                        <!-- Info -->
                        <div class="mt-6 pt-6 border-t border-cream-pastel">
                            <p class="text-sm text-dark-cocoa">
                                Dengan melanjutkan, Anda menyetujui 
                                <a href="#" class="text-rose-gold hover:underline">Syarat & Ketentuan</a> kami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- CTA Section -->
        <div class="mt-16 p-8 bg-gradient-to-r from-rose-gold/10 to-lavender-mist rounded-2xl text-center animate-fade-in-up" style="animation-delay: 0.7s">
            <h3 class="font-serif text-2xl text-rose-gold mb-4">Butuh Bantuan?</h3>
            <p class="text-cocoa-brown max-w-2xl mx-auto mb-6">
                Tim customer service kami siap membantu 24/7. Hubungi kami untuk pertanyaan tentang produk, pemesanan, atau informasi lainnya.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:info@eclairora.com" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Email Kami
                </a>
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-green-500 text-green-500 font-semibold rounded-full hover:bg-green-500 hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
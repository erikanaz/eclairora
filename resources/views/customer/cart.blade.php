@php
    use App\Services\SupabaseService;
    $supabase = new SupabaseService();
@endphp

<x-app-layout>
    <!-- CSS untuk loading spinner -->
    <style>
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .btn-loading {
            position: relative;
            color: transparent !important;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 20px;
            height: 20px;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #fff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }
        
        /* Animation untuk remove item */
        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
                max-height: 500px;
            }
            to {
                opacity: 0;
                transform: translateX(-100px);
                max-height: 0;
                padding: 0;
                margin: 0;
                border: none;
            }
        }
        
        .item-removing {
            animation: slideOut 0.3s ease forwards;
            overflow: hidden;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 md:px-10 py-2">
        <!-- Header -->
        <div class="text-center mb-12 animate-fade-in-up">
            <h1 class="font-serif text-4xl md:text-5xl text-rose-gold mb-4">
                Keranjang Belanja
            </h1>
            <p class="text-lg md:text-xl text-cocoa-brown max-w-3xl mx-auto">
                Review pesanan Anda sebelum checkout
            </p>
        </div>

        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Daftar Item -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-serif text-2xl text-cocoa-brown">
                            {{ $cart->totalItems() }} Item di Keranjang
                        </h2>
                        <button id="clear-cart-btn" 
                                class="text-sm px-4 py-2 text-red-500 hover:text-white hover:bg-red-500 border border-red-500 hover:border-red-500 rounded-full transition-colors duration-300">
                            Kosongkan Keranjang
                        </button>
                    </div>
                    
                    <!-- Daftar Produk -->
                    <div id="cart-items-container" class="space-y-6">
                        @foreach($cartItems as $item)
                        <div class="cart-item flex flex-col sm:flex-row gap-4 p-4 border-b border-cream-pastel last:border-b-0 animate-fade-in-up" 
                             style="animation-delay: {{ 0.2 + ($loop->index * 0.1) }}s"
                             data-item-id="{{ $item->id }}">
                            <!-- Gambar Produk -->
                            <div class="sm:w-32 sm:h-32 w-full h-32 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image ? $supabase->getPublicUrl($item->product->image) : asset('images/default-pastry.png') }}"
								alt="{{ $item->product->name }}"
								class="w-full h-full object-cover"
								onerror="this.onerror=null; this.src='{{ asset('images/default-pastry.png') }}'">
                            </div>
                            
                            <!-- Detail Produk -->
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-serif text-xl text-cocoa-brown mb-1">{{ $item->product->name }}</h3>
                                        @if($item->product->category)
                                        <span class="text-xs px-2 py-1 bg-lavender-mist text-cocoa-brown rounded-full">
                                            {{ $item->product->category->name }}
                                        </span>
                                        @endif
                                    </div>
                                    <button class="remove-item-btn text-red-500 hover:text-red-700 transition-colors" 
                                            data-item-id="{{ $item->id }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <p class="text-dark-cocoa text-sm mb-4 line-clamp-2">
                                    {{ $item->product->description ?: 'Pastry premium dengan kualitas terbaik.' }}
                                </p>
                                
                                <div class="flex justify-between items-center">
                                    <!-- Quantity Control -->
                                    <div class="flex items-center">
                                        <button class="decrease-qty px-3 py-1 bg-cream-pastel text-cocoa-brown rounded-l-full hover:bg-rose-gold hover:text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                                data-item-id="{{ $item->id }}">
                                            -
                                        </button>
                                        <input type="number" 
                                               min="1" 
                                               value="{{ $item->quantity }}" 
                                               class="w-16 text-center py-1 bg-white border-y border-cream-pastel appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [&::-moz-appearance:textfield] quantity-input"
                                               data-item-id="{{ $item->id }}"
                                               data-price="{{ $item->product->price }}">
                                        <button class="increase-qty px-3 py-1 bg-cream-pastel text-cocoa-brown rounded-r-full hover:bg-rose-gold hover:text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                                data-item-id="{{ $item->id }}">
                                            +
                                        </button>
                                    </div>
                                    
                                    <!-- Harga -->
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-rose-gold item-subtotal" 
                                           data-item-id="{{ $item->id }}"
                                           data-price="{{ $item->product->price }}">
                                            Rp {{ number_format($item->subtotal(), 0, ',', '.') }}
                                        </p>
                                        <p class="text-sm text-cocoa-brown">
                                            Rp {{ number_format($item->product->price, 0, ',', '.') }} / item
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Continue Shopping Button -->
                <div class="text-center animate-fade-in-up" style="animation-delay: 0.5s">
                    <a href="{{ route('customer.products.index') }}" 
                       class="inline-flex items-center px-6 py-3 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Lanjutkan Belanja
                    </a>
                </div>
            </div>
            
            <!-- Ringkasan Pesanan -->
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white rounded-2xl shadow-lg p-6 animate-fade-in-up" style="animation-delay: 0.3s">
                        <h2 class="font-serif text-2xl text-cocoa-brown mb-6">Ringkasan Pesanan</h2>
                        
                        <!-- Detail Harga -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-dark-cocoa">Subtotal</span>
                                <span class="text-cocoa-brown font-semibold" id="subtotal-display">
                                    Rp {{ number_format($cart->totalPrice(), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-dark-cocoa">Biaya Pengiriman</span>
                                <span class="text-cocoa-brown font-semibold">Rp 15.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-dark-cocoa">Pajak (10%)</span>
                                <span class="text-cocoa-brown font-semibold" id="tax-display">
                                    Rp {{ number_format($cart->totalPrice() * 0.1, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="border-t border-cream-pastel pt-4">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-cocoa-brown">Total</span>
                                    <span class="text-2xl font-bold text-rose-gold" id="total-display">
                                        Rp {{ number_format($cart->totalPrice() + 15000 + ($cart->totalPrice() * 0.1), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Checkout Button -->
                        @if($cart->totalItems() > 0)
                        <a href="{{ route('customer.orders.checkout') }}" 
                           class="block w-full text-center px-6 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 shadow-lg hover:shadow-xl mb-4">
                            Lanjut ke Checkout
                        </a>
                        @else
                        <button class="block w-full text-center px-6 py-3 bg-gray-300 text-gray-500 font-semibold rounded-full cursor-not-allowed mb-4">
                            Keranjang Kosong
                        </button>
                        @endif
                        
                        <!-- Payment Methods -->
                        {{-- <div class="border-t border-cream-pastel pt-6">
                            <p class="text-dark-cocoa mb-3">Metode Pembayaran:</p>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="p-2 border border-cream-pastel rounded-lg text-center">
                                    <div class="text-xs text-cocoa-brown">Transfer Bank</div>
                                </div>
                                <div class="p-2 border border-cream-pastel rounded-lg text-center">
                                    <div class="text-xs text-cocoa-brown">E-Wallet</div>
                                </div>
                                <div class="p-2 border border-cream-pastel rounded-lg text-center">
                                    <div class="text-xs text-cocoa-brown">COD</div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    
                    <!-- Info Tambahan -->
                    {{-- <div class="mt-6 bg-gradient-to-r from-rose-gold/10 to-lavender-mist rounded-2xl p-6 animate-fade-in-up" style="animation-delay: 0.4s">
                        <h3 class="font-serif text-xl text-rose-gold mb-3">💡 Tips</h3>
                        <ul class="text-sm text-cocoa-brown space-y-2">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-rose-gold mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Produk akan diproses dalam 2 jam setelah checkout
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-rose-gold mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Pengiriman gratis untuk pembelian di atas Rp 200.000
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-rose-gold mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Bisa diambil langsung di toko kami
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart State -->
        <div class="text-center py-16 animate-fade-in-up">
            <svg class="w-32 h-32 mx-auto text-rose-gold/30 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="font-serif text-3xl text-cocoa-brown mb-4">Keranjang Anda Kosong</h3>
            <p class="text-dark-cocoa mb-8 max-w-md mx-auto">
                Tambahkan beberapa pastry lezat ke keranjang Anda untuk memulai belanja
            </p>
            <a href="{{ route('customer.products.index') }}" 
               class="inline-flex items-center px-8 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Jelajahi Produk
            </a>
        </div>
        @endif

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

    

    <!-- Notification Container -->
    <div id="notification-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        // Inisialisasi animasi
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Cart page loaded');
            
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.animate-fade-in-up').forEach(element => {
                observer.observe(element);
            });
            
            // Format Rupiah
            function formatRupiah(amount) {
                return 'Rp ' + amount.toLocaleString('id-ID');
            }
            
            // Parse Rupiah ke angka
            function parseRupiah(rupiahString) {
                return parseInt(rupiahString.replace(/[^\d]/g, '')) || 0;
            }
            
            // Update ringkasan pesanan
            function updateSummary() {
                let subtotal = 0;
                
                // Hitung subtotal dari semua item
                document.querySelectorAll('.item-subtotal').forEach(element => {
                    const priceText = element.textContent;
                    subtotal += parseRupiah(priceText);
                });
                
                const tax = subtotal * 0.1;
                const shipping = 15000;
                const total = subtotal + tax + shipping;
                
                // Update display
                document.getElementById('subtotal-display').textContent = formatRupiah(subtotal);
                document.getElementById('tax-display').textContent = formatRupiah(tax);
                document.getElementById('total-display').textContent = formatRupiah(total);
            }
            
            // Update quantity item
            function updateItemSubtotal(itemId, newQuantity) {
                const subtotalElement = document.querySelector(`.item-subtotal[data-item-id="${itemId}"]`);
                if (!subtotalElement) {
                    console.error(`Element not found for itemId: ${itemId}`);
                    return;
                }
                
                const pricePerItem = parseInt(subtotalElement.getAttribute('data-price'));
                const newSubtotal = pricePerItem * newQuantity;
                
                subtotalElement.textContent = formatRupiah(newSubtotal);
            }
            
            // Disable/enable buttons selama proses
            function setButtonsDisabled(itemId, disabled) {
                const increaseBtn = document.querySelector(`.increase-qty[data-item-id="${itemId}"]`);
                const decreaseBtn = document.querySelector(`.decrease-qty[data-item-id="${itemId}"]`);
                const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                
                if (increaseBtn) increaseBtn.disabled = disabled;
                if (decreaseBtn) decreaseBtn.disabled = disabled;
                if (input) input.disabled = disabled;
            }
            
            // Update quantity dengan AJAX
            function updateQuantity(itemId, newQuantity) {
                console.log(`Updating item ${itemId} to quantity ${newQuantity}`);
                
                // Disable buttons selama proses
                setButtonsDisabled(itemId, true);
                
                // Update subtotal item secara lokal
                updateItemSubtotal(itemId, newQuantity);
                
                // Update ringkasan
                updateSummary();
                
                // ENDPOINT YANG BENAR berdasarkan route Anda
                const url = `/customer/cart/update/${itemId}`;
                
                console.log(`Sending PUT request to: ${url}`);
                
                fetch(url, {
                    method: 'PUT', // SESUAI ROUTE: PUT customer/cart/update/{item}
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 
                        quantity: newQuantity
                    })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    
                    if (response.status === 403) {
                        throw new Error('Unauthorized - Silahkan login kembali');
                    }
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    
                    if (data.success) {
                        showNotification(data.message || 'Quantity berhasil diupdate', 'success');
                        
                        // Update cart count di navbar jika ada
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount && data.total_items !== undefined) {
                            cartCount.textContent = data.total_items;
                        }
                    } else {
                        throw new Error(data.message || 'Update failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                    // Rollback UI jika error
                    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                    if (input) {
                        const oldValue = input.getAttribute('data-old-value');
                        if (oldValue) {
                            input.value = oldValue;
                            updateItemSubtotal(itemId, parseInt(oldValue));
                            updateSummary();
                        }
                    }
                    
                    showNotification('Gagal mengupdate quantity: ' + error.message, 'error');
                })
                .finally(() => {
                    // Enable buttons setelah selesai
                    setTimeout(() => {
                        setButtonsDisabled(itemId, false);
                    }, 500);
                });
            }
            
            // Simpan nilai lama sebelum update
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.setAttribute('data-old-value', input.value);
                
                input.addEventListener('focus', function() {
                    this.setAttribute('data-old-value', this.value);
                });
            });
            
            // Event listeners untuk quantity controls
            document.querySelectorAll('.increase-qty').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                    if (!input) return;
                    
                    const currentValue = parseInt(input.value);
                    const newQuantity = currentValue + 1;
                    input.value = newQuantity;
                    
                    // Simpan nilai lama untuk rollback
                    input.setAttribute('data-old-value', currentValue);
                    
                    updateQuantity(itemId, newQuantity);
                });
            });
            
            document.querySelectorAll('.decrease-qty').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                    if (!input) return;
                    
                    const currentValue = parseInt(input.value);
                    let newQuantity = currentValue - 1;
                    
                    if (newQuantity < 1) newQuantity = 1;
                    input.value = newQuantity;
                    
                    // Simpan nilai lama untuk rollback
                    input.setAttribute('data-old-value', currentValue);
                    
                    if (newQuantity >= 1 && newQuantity !== currentValue) {
                        updateQuantity(itemId, newQuantity);
                    }
                });
            });
            
            // Input manual quantity
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const itemId = this.getAttribute('data-item-id');
                    let newQuantity = parseInt(this.value);
                    
                    if (isNaN(newQuantity) || newQuantity < 1) {
                        newQuantity = 1;
                        this.value = 1;
                    }
                    
                    const oldValue = parseInt(this.getAttribute('data-old-value') || '1');
                    
                    if (newQuantity !== oldValue) {
                        updateQuantity(itemId, newQuantity);
                        this.setAttribute('data-old-value', newQuantity);
                    }
                });
            });
            
            // Hapus item dari cart - FIXED SELECTOR
            document.querySelectorAll('.remove-item-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    
                    // CARA YANG LEBIH TEPAT: Cari elemen dengan data-item-id yang sama
                    const itemElement = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                    
                    if (!itemElement) {
                        console.error(`Item element not found for ID: ${itemId}`);
                        return;
                    }
                    
                    if (confirm('Hapus produk dari keranjang?')) {
                        // Tampilkan loading
                        this.innerHTML = '<div class="loading-spinner"></div>';
                        this.disabled = true;
                        
                        // ENDPOINT YANG BENAR
                        const url = `/customer/cart/remove/${itemId}`;
                        
                        fetch(url, {
                            method: 'DELETE', // SESUAI ROUTE: DELETE customer/cart/remove/{item}
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            console.log('Remove response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message, 'success');
                                
                                // Animasi penghapusan
                                itemElement.classList.add('item-removing');
                                
                                setTimeout(() => {
                                    // Hapus elemen dari DOM
                                    itemElement.remove();
                                    
                                    // Update ringkasan
                                    updateSummary();
                                    
                                    // Update cart count di navbar
                                    const cartCount = document.getElementById('cart-count');
                                    if (cartCount && data.total_items !== undefined) {
                                        cartCount.textContent = data.total_items;
                                    }
                                    
                                    // Jika keranjang kosong, reload halaman
                                    if (data.total_items === 0) {
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1000);
                                    }
                                }, 300);
                                
                            } else {
                                showNotification(data.message || 'Gagal menghapus', 'error');
                                // Reset button
                                this.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>';
                                this.disabled = false;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('Gagal menghapus item: ' + error.message, 'error');
                            // Reset button
                            this.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>';
                            this.disabled = false;
                        });
                    }
                });
            });
            
            // Kosongkan cart
            const clearCartBtn = document.getElementById('clear-cart-btn');
            if (clearCartBtn) {
                clearCartBtn.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                        // Tampilkan loading
                        const originalText = this.textContent;
                        this.innerHTML = '<div class="loading-spinner"></div>';
                        this.disabled = true;
                        
                        // ENDPOINT YANG BENAR
                        const url = '/customer/cart/clear';
                        
                        fetch(url, {
                            method: 'DELETE', // SESUAI ROUTE: DELETE customer/cart/clear
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message, 'success');
                                
                                // Update cart count di navbar
                                const cartCount = document.getElementById('cart-count');
                                if (cartCount) {
                                    cartCount.textContent = 0;
                                }
                                
                                // Animasi untuk semua item
                                document.querySelectorAll('.cart-item').forEach(item => {
                                    item.classList.add('item-removing');
                                });
                                
                                // Reload halaman setelah animasi
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                                
                            } else {
                                showNotification(data.message || 'Gagal mengosongkan', 'error');
                                // Reset button
                                this.textContent = originalText;
                                this.disabled = false;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('Terjadi kesalahan: ' + error.message, 'error');
                            // Reset button
                            this.textContent = originalText;
                            this.disabled = false;
                        });
                    }
                });
            }
            
            // Fungsi notifikasi
            function showNotification(message, type = 'success') {
                const container = document.getElementById('notification-container');
                const notification = document.createElement('div');
                
                const bgColor = type === 'success' ? 'bg-green-500' : 
                               type === 'error' ? 'bg-red-500' : 
                               type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';
                
                notification.className = `px-6 py-3 rounded-lg shadow-lg mb-2 animate-fade-in-up ${bgColor} text-white`;
                notification.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${type === 'success' ? 
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />' :
                                type === 'error' ?
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.47 16.5c-.77.833.192 2.5 1.732 2.5z" />' :
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
                            }
                        </svg>
                        ${message}
                    </div>
                `;
                
                container.appendChild(notification);
                
                setTimeout(() => {
                    notification.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            }
            
            // Inisialisasi summary
            updateSummary();
            
            // Debug info
            console.log('Cart items count:', document.querySelectorAll('.cart-item').length);
        });
    </script>
</x-app-layout>
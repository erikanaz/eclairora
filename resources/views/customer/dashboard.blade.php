@php
    use App\Services\SupabaseService;
    $supabase = new SupabaseService();
@endphp

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 md:px-10 py-2">
        <!-- Selamat Datang Section -->
        <div class="text-center mb-12 animate-fade-in-up">
            <h1 class="font-serif text-4xl md:text-5xl text-rose-gold mb-4">
                Selamat Datang, {{ Auth::user()->name }} 👋
            </h1>
            <p class="text-lg md:text-xl text-cocoa-brown max-w-2xl mx-auto">
                Nikmati {{ $totalProducts }} kue pastry premium kami yang dibuat dengan penuh passion. 
                Setiap gigitan bersinar dengan keunggulan.
            </p>
            
            <!-- Tanggal dan waktu -->
            <div class="mt-4 text-cocoa-brown/70">
                <p>{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>

        <!-- Kartu Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Kartu Produk -->
            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:-translate-y-1 transition-all duration-300 group animate-fade-in-up" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-rose-gold/10 rounded-full">
                        <svg class="w-6 h-6 text-rose-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-cocoa-brown">{{ $totalProducts }}</span>
                </div>
                <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Koleksi Pastry</h3>
                <p class="text-dark-cocoa mb-4">Jelajahi pilihan pastry premium kami</p>
                <a href="{{ route('customer.products.index') }}" 
                   class="inline-flex items-center text-rose-gold font-semibold group-hover:text-cocoa-brown transition-colors duration-300">
                    Lihat Semua Produk
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <!-- Kartu Keranjang -->
            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:-translate-y-1 transition-all duration-300 group animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-rose-gold/10 rounded-full">
                        <svg class="w-6 h-6 text-rose-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span id="cart-count-dashboard" class="text-2xl font-bold text-cocoa-brown">{{ $cartCount }}</span>
                </div>
                <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Keranjang Anda</h3>
                <p class="text-dark-cocoa mb-4">{{ $cartCount > 0 ? 'Ada ' . $cartCount . ' item menunggu' : 'Belum ada item di keranjang' }}</p>
                <a href="{{ route('customer.cart') }}" 
                   class="inline-flex items-center text-rose-gold font-semibold group-hover:text-cocoa-brown transition-colors duration-300">
                    {{ $cartCount > 0 ? 'Lihat & Checkout' : 'Lihat Keranjang' }}
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <!-- Kartu Pesanan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:-translate-y-1 transition-all duration-300 group animate-fade-in-up" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-rose-gold/10 rounded-full">
                        <svg class="w-6 h-6 text-rose-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-cocoa-brown">{{ $orderCount }}</span>
                </div>
                <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Riwayat Pesanan</h3>
                <p class="text-dark-cocoa mb-4">{{ $orderCount > 0 ? 'Ada ' . $orderCount . ' pesanan' : 'Belum ada pesanan' }}</p>
                <a href="{{ route('customer.orders.index') }}" 
                   class="inline-flex items-center text-rose-gold font-semibold group-hover:text-cocoa-brown transition-colors duration-300">
                    {{ $orderCount > 0 ? 'Lihat Pesanan' : 'Lihat Halaman Pesanan' }}
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        {{-- <div class="mb-12 animate-fade-in-up" style="animation-delay: 0.4s">
            <h2 class="font-serif text-3xl text-rose-gold mb-6 text-center">Aksi Cepat</h2>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('customer.products.index') }}" 
                   class="px-8 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transform hover:-translate-y-0.5 transition-all duration-300 shadow-lg hover:shadow-xl text-center flex-1 sm:flex-none">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari Pastry
                    </div>
                </a>
                
                @if($cartCount > 0)
                <a href="{{ route('customer.cart') }}" 
                   class="px-8 py-3 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 text-center flex-1 sm:flex-none">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Lanjut ke Checkout
                    </div>
                </a>
                @else
                <a href="{{ route('customer.products.index') }}" 
                   class="px-8 py-3 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 text-center flex-1 sm:flex-none">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Mulai Belanja
                    </div>
                </a>
                @endif
                
                <a href="{{ route('customer.orders.index') }}" 
                   class="px-8 py-3 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 text-center flex-1 sm:flex-none">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Pesanan Saya
                    </div>
                </a>
            </div>
        </div> --}}

        <!-- Produk Unggulan -->
        @if($featuredProducts->count() > 0)
        <div class="animate-fade-in-up" style="animation-delay: 0.5s">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-serif text-3xl text-rose-gold ">Pastry Terbaru</h2>
                <a href="{{ route('customer.products.index') }}" class="text-rose-gold hover:text-cocoa-brown transition-colors duration-300 flex items-center">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-72 overflow-hidden">
                        <img src="{{ $product->image ? $supabase->getPublicUrl($product->image) : asset('images/default-pastry.png') }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.onerror=null; this.src='{{ asset('images/default-pastry.png') }}'">
                        <span class="absolute top-3 left-3 px-3 py-1 bg-rose-gold text-white text-sm font-semibold rounded-full">
                            Baru
                        </span>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-serif text-xl text-cocoa-brown">{{ $product->name }}</h3>
                            @if($product->category)
                            <span class="text-xs px-2 py-1 bg-lavender-mist text-cocoa-brown rounded-full">
                                {{ $product->category->name }}
                            </span>
                            @endif
                        </div>
                        
                        <p class="text-dark-cocoa mb-4 text-sm line-clamp-2">
                            {{ $product->description ?: 'Pastry premium dengan kualitas terbaik.' }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-rose-gold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <form action="{{ route('customer.cart.add', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-sm px-4 py-2 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-colors duration-300 add-to-cart-dashboard"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}">
                                    + Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Kategori Populer -->
        {{-- @if($categories->count() > 0)
        <div class="mt-16 animate-fade-in-up" style="animation-delay: 0.6s">
            <h2 class="font-serif text-3xl text-rose-gold mb-8 text-center">Kategori Populer</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                <a href="{{ route('customer.products.index', ['category' => $category->id]) }}" 
                   class="bg-white rounded-xl p-6 text-center shadow hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="p-3 bg-rose-gold/10 rounded-full inline-flex mb-3">
                        <svg class="w-6 h-6 text-rose-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-cocoa-brown group-hover:text-rose-gold transition-colors">{{ $category->name }}</h3>
                    <p class="text-sm text-dark-cocoa mt-1">
                        @php
                            $productCount = $category->products()->count();
                        @endphp
                        {{ $productCount }} {{ $productCount == 1 ? 'produk' : 'produk' }}
                    </p>
                </a>
                @endforeach
            </div>
        </div>
        @endif --}}

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
    <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <script>
        // Dashboard JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard loaded');
            
            // Animasi
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
            
            // Hover effects
            const cards = document.querySelectorAll('.bg-white.rounded-2xl');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Add to cart dari dashboard
            document.querySelectorAll('.add-to-cart-dashboard').forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    
                    const productId = this.getAttribute('data-product-id');
                    const productName = this.getAttribute('data-product-name');
                    const originalText = this.innerHTML;
                    
                    // Loading state
                    this.innerHTML = 'Menambahkan...';
                    this.disabled = true;
                    this.classList.add('opacity-50');
                    
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        
                        const response = await fetch(`/customer/cart/add/${productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: `_token=${encodeURIComponent(csrfToken)}`
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            showNotification(`✓ ${productName} berhasil ditambahkan!`, 'success');
                            updateDashboardCartCount(data.cart_count);
                        } else {
                            showNotification(`❌ ${data.message}`, 'error');
                        }
                        
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification('❌ Gagal menambahkan produk', 'error');
                    } finally {
                        // Reset button
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                            this.classList.remove('opacity-50');
                        }, 1000);
                    }
                });
            });
            
            // Update cart count di dashboard
            function updateDashboardCartCount(count) {
                // Update counter di dashboard
                const dashboardCounter = document.getElementById('cart-count-dashboard');
                if (dashboardCounter) {
                    dashboardCounter.textContent = count;
                }
                
                // Update semua counters di halaman
                const allCounters = document.querySelectorAll('#cart-count');
                allCounters.forEach(counter => {
                    counter.textContent = count;
                    counter.classList.toggle('hidden', count === 0);
                });
                
                // Update text pada card keranjang
                const cartCardText = document.querySelector('.bg-white.rounded-2xl:nth-child(2) .text-dark-cocoa');
                if (cartCardText) {
                    cartCardText.textContent = count > 0 
                        ? 'Ada ' + count + ' item menunggu' 
                        : 'Belum ada item di keranjang';
                }
                
                // Update link text
                const cartLink = document.querySelector('.bg-white.rounded-2xl:nth-child(2) a');
                if (cartLink) {
                    cartLink.innerHTML = (count > 0 ? 'Lihat & Checkout' : 'Lihat Keranjang') + 
                        '<svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />' +
                        '</svg>';
                }
            }
            
            // Notification function
            function showNotification(message, type = 'success') {
                let container = document.getElementById('notification-container');
                if (!container) {
                    container = document.createElement('div');
                    container.id = 'notification-container';
                    container.className = 'fixed top-4 right-4 z-50 space-y-2';
                    document.body.appendChild(container);
                }
                
                const notification = document.createElement('div');
                notification.className = `px-6 py-3 rounded-lg shadow-lg animate-fade-in-up ${
                    type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${type === 'success' ? 
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />' :
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.47 16.5c-.77.833.192 2.5 1.732 2.5z" />'
                            }
                        </svg>
                        ${message}
                    </div>
                `;
                
                container.appendChild(notification);
                
                setTimeout(() => {
                    notification.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        });
    </script>
</x-app-layout>
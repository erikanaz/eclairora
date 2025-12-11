<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 md:px-10 py-2">
        <!-- Header -->
        <div class="text-center mb-12 animate-fade-in-up">
            <h1 class="font-serif text-4xl md:text-5xl text-rose-gold mb-4">
                Koleksi Pastry Premium Kami
            </h1>
            <p class="text-lg md:text-xl text-cocoa-brown max-w-3xl mx-auto">
                Temukan kelezatan dalam setiap gigitan. {{ $products->count() }} pastry dibuat dengan bahan-bahan pilihan dan penuh passion.
            </p>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="mb-8 bg-white rounded-2xl shadow-lg p-6 animate-fade-in-up" style="animation-delay: 0.1s">
            <form action="{{ route('customer.products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 justify-between items-center">
                <!-- Search Bar -->
                <div class="flex-1 w-full md:w-auto">
                    <div class="relative">
                        <input type="text" 
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari pastry..." 
                               class="w-full px-4 py-3 pl-12 bg-cream-pastel border border-rose-gold/20 rounded-full focus:outline-none focus:ring-2 focus:ring-rose-gold/50 focus:border-transparent">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-rose-gold" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Filter Categories -->
                @if($categories->count() > 0)
                <div class="flex flex-wrap gap-2">
                    <button type="button" 
                            onclick="window.location.href='{{ route('customer.products.index') }}'"
                            class="px-4 py-2 {{ !request('category') ? 'bg-rose-gold text-white' : 'bg-cream-pastel text-cocoa-brown' }} rounded-full hover:bg-cocoa-brown hover:text-white transition-colors duration-300">
                        Semua
                    </button>
                    @foreach($categories as $category)
                    <button type="button" 
                            onclick="window.location.href='{{ route('customer.products.index', ['category' => $category->id]) }}'"
                            class="px-4 py-2 {{ request('category') == $category->id ? 'bg-rose-gold text-white' : 'bg-cream-pastel text-cocoa-brown' }} rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>
                @endif

                <!-- Sort Dropdown -->
                <div class="relative">
                    <select name="sort" 
                            onchange="this.form.submit()"
                            class="appearance-none px-4 py-2 bg-cream-pastel border border-rose-gold/20 rounded-full focus:outline-none focus:ring-2 focus:ring-rose-gold/50 focus:border-transparent">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Termurah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Termahal</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama: A-Z</option>
                    </select>
                    <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-4 h-4 text-rose-gold pointer-events-none" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </form>
        </div>

        @if($products->count() > 0)
        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
            @foreach($products as $index => $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s">
                <div class="relative h-72 overflow-hidden">
                    @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        onerror="this.onerror=null; this.src='{{ asset('images/default-pastry.png') }}'">
                    @else
                    <div class="w-full h-full bg-cream-pastel flex items-center justify-center">
                        <svg class="w-16 h-16 text-rose-gold/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                    
                    <!-- Anda bisa menambahkan badge khusus berdasarkan logika bisnis -->
                    @if($loop->first)
                    <span class="absolute top-3 left-3 px-3 py-1 bg-rose-gold text-white text-sm font-semibold rounded-full">
                        Terbaru
                    </span>
                    @endif
                    
                    @if($loop->iteration <= 3)
                    <span class="absolute top-3 left-3 px-3 py-1 {{ $loop->iteration == 1 ? 'bg-rose-gold' : ($loop->iteration == 2 ? 'bg-red-500' : 'bg-green-500') }} text-white text-sm font-semibold rounded-full">
                        {{ $loop->iteration == 1 ? 'Terlaris' : ($loop->iteration == 2 ? 'Hampir Habis' : 'Baru') }}
                    </span>
                    @endif
                </div>
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-serif text-2xl text-cocoa-brown">{{ $product->name }}</h3>
                        @if($product->category)
                        <span class="text-xs px-2 py-1 bg-lavender-mist text-cocoa-brown rounded-full">
                            {{ $product->category->name }}
                        </span>
                        @endif
                    </div>
                    
                    <p class="text-dark-cocoa mb-4 text-sm line-clamp-2">
                        {{ $product->description ?: 'Pastry premium dengan kualitas terbaik.' }}
                    </p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-2xl font-bold text-rose-gold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <!-- HAPUS form dan ganti dengan button sederhana -->
                        <button type="button" 
                                class="w-full px-4 py-2 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-colors duration-300 flex items-center justify-center gap-2 add-to-cart-btn"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-add-url="{{ route('customer.cart.add', $product->id) }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Info Jumlah Produk -->
        <div class="mt-8 text-center animate-fade-in-up" style="animation-delay: 0.8s">
            <p class="text-cocoa-brown">
                Menampilkan <span class="font-semibold text-rose-gold">{{ $products->count() }}</span> produk pastry
            </p>
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16 animate-fade-in-up">
            <svg class="w-24 h-24 mx-auto text-rose-gold/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Produk tidak ditemukan</h3>
            <p class="text-dark-cocoa mb-6">Coba gunakan kata kunci atau filter yang berbeda</p>
            <a href="{{ route('customer.products.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300">
                Tampilkan Semua Produk
            </a>
        </div>
        @endif

        <!-- CTA Section -->
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
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Product page JavaScript loaded - DEBUG VERSION');
    
    // 1. FUNGSI NOTIFIKASI
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
    
    // 2. UPDATE CART COUNTER
    function updateCartCounter(count) {
        console.log('🛍️ Updating cart counter to:', count);
        const cartCountElements = document.querySelectorAll('#cart-count, .cart-count, [data-cart-count]');
        cartCountElements.forEach(element => {
            element.textContent = count;
            if (count > 0) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        });
    }
    
    // 3. DEBUG: Log semua informasi penting
    console.log('🔍 Found add-to-cart buttons:', document.querySelectorAll('.add-to-cart-btn').length);
    
    // Cek CSRF token
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (csrfMeta) {
        console.log('✅ CSRF token found:', csrfMeta.getAttribute('content') ? 'Yes' : 'No');
    } else {
        console.error('❌ CSRF token meta tag not found!');
    }
    
    // 4. SIMPLE & RELIABLE ADD TO CART HANDLER
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const originalText = this.innerHTML;
            
            console.log('🛒 Attempting to add product:', {
                productId: productId,
                productName: productName,
                button: this
            });
            
            // Show loading
            this.innerHTML = `
                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Menambahkan...
            `;
            this.disabled = true;
            this.classList.add('opacity-50', 'cursor-not-allowed');
            
            try {
                // Get CSRF token - FIXED VERSION
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }
                
                console.log('📤 Sending request to:', `/customer/cart/add/${productId}`);
                
                // OPTION 1: Simple URL encoded (RECOMMENDED)
                const formData = new URLSearchParams();
                formData.append('_token', csrfToken);
                
                const response = await fetch(`/customer/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData.toString(),
                    credentials: 'same-origin' // Important for sessions
                });
                
                console.log('📥 Response status:', response.status, response.statusText);
                
                if (!response.ok) {
                    let errorMsg = `HTTP ${response.status}`;
                    if (response.status === 404) {
                        errorMsg = 'Route not found (404). Check your routes.';
                    } else if (response.status === 419) {
                        errorMsg = 'Session expired. Please refresh.';
                    } else if (response.status === 403) {
                        errorMsg = 'Access forbidden. Make sure you are logged in.';
                    }
                    throw new Error(errorMsg);
                }
                
                const data = await response.json();
                console.log('📊 Response data:', data);
                
                if (data.success) {
                    showNotification(`✓ ${productName} berhasil ditambahkan ke keranjang!`, 'success');
                    updateCartCounter(data.cart_count);
                    
                    // Visual feedback
                    this.classList.remove('bg-rose-gold', 'bg-cocoa-brown');
                    this.classList.add('bg-green-500');
                    
                    setTimeout(() => {
                        this.classList.remove('bg-green-500');
                        this.classList.add('bg-rose-gold');
                    }, 800);
                    
                } else {
                    showNotification(`❌ ${data.message || 'Gagal menambahkan produk'}`, 'error');
                }
                
            } catch (error) {
                console.error('❌ Fetch error details:', error);
                
                // Show specific error messages
                if (error.message.includes('CSRF')) {
                    showNotification('❌ CSRF token tidak ditemukan. Refresh halaman.', 'error');
                } else if (error.message.includes('404')) {
                    showNotification('❌ Route tidak ditemukan. Periksa route di routes/web.php', 'error');
                } else if (error.message.includes('419')) {
                    showNotification('❌ Session expired. Silakan login kembali.', 'error');
                } else if (error.message.includes('403')) {
                    showNotification('❌ Akses ditolak. Pastikan role Anda adalah "customer".', 'error');
                } else {
                    showNotification(`❌ Error: ${error.message}`, 'error');
                }
                
            } finally {
                // Reset button
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                    this.classList.remove('opacity-50', 'cursor-not-allowed');
                }, 1500);
            }
        });
    });
    
    // 5. LOAD INITIAL CART COUNT - IMPROVED
    async function loadCartCount() {
        try {
            // First try server API
            const response = await fetch('/customer/cart/count', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });
            
            if (response.ok) {
                const data = await response.json();
                if (data.success) {
                    updateCartCounter(data.count);
                    console.log('🛍️ Cart count from API:', data.count);
                    return;
                }
            }
        } catch (error) {
            console.log('Using fallback cart count method');
        }
        
        // Fallback: check navbar
        const cartCountElement = document.querySelector('#cart-count');
        if (cartCountElement) {
            const count = parseInt(cartCountElement.textContent) || 0;
            updateCartCounter(count);
            console.log('🛍️ Cart count from navbar:', count);
        }
    }
    
    // 6. INITIALIZE
    loadCartCount();
    
    // 7. ANIMATIONS (optional)
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
    
    document.querySelectorAll('.animate-fade-in-up:not(.animated)').forEach(element => {
        observer.observe(element);
    });
});
</script>
</x-app-layout>
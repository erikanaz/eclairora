<nav class="sticky top-0 z-50 bg-white shadow-sm px-4 md:px-10 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="font-serif text-2xl md:text-3xl font-bold text-rose-gold tracking-wide">
            <a href="{{ route('customer.dashboard') }}" class="hover:text-cocoa-brown transition-colors duration-300">
                Éclairora
            </a>
        </div>
        
        <!-- Desktop Navigation -->
        <ul class="hidden md:flex items-center space-x-6">
            <li>
                <a href="{{ route('customer.dashboard') }}" 
                   class="font-semibold hover:text-rose-gold transition-colors duration-300 {{ request()->routeIs('customer.dashboard') ? 'text-rose-gold' : 'text-dark-cocoa' }}">
                   Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('customer.products.index') }}" 
                   class="font-semibold hover:text-rose-gold transition-colors duration-300 {{ request()->routeIs('customer.products.*') ? 'text-rose-gold' : 'text-dark-cocoa' }}">
                   Produk
                </a>
            </li>
            <li class="relative">
                <a href="{{ route('customer.cart') }}" 
                   class="font-semibold hover:text-rose-gold transition-colors duration-300 {{ request()->routeIs('customer.cart') ? 'text-rose-gold' : 'text-dark-cocoa' }} flex items-center">
                   <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                   </svg>
                   Keranjang
                   @php
                       $cartCount = Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->first()?->totalItems() ?? 0 : 0;
                   @endphp
                   @if($cartCount > 0)
                   <span id="cart-count" class="ml-1 bg-rose-gold text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                       {{ $cartCount }}
                   </span>
                   @endif
                </a>
            </li>
            <li>
                <a href="{{ route('customer.orders.index') }}" 
                   class="font-semibold hover:text-rose-gold transition-colors duration-300 {{ request()->routeIs('customer.orders.*') ? 'text-rose-gold' : 'text-dark-cocoa' }}">
                   Pesanan
                </a>
            </li>
            
            <!-- User Dropdown -->
            <li class="relative group ml-4">
                <button class="flex items-center space-x-2 font-semibold text-dark-cocoa hover:text-rose-gold transition-colors duration-300 focus:outline-none">
                    <div class="w-8 h-8 bg-rose-gold/10 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-rose-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50">
                    <div class="py-1">
                        <a href="{{ route('profile.edit') }}" 
                           class="block px-4 py-3 text-sm text-dark-cocoa hover:bg-cream-pastel hover:text-rose-gold transition-colors duration-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil Saya
                        </a>
                        
                        <div class="border-t border-cream-pastel my-1"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-cream-pastel transition-colors duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-rose-gold focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg px-4 py-4 mt-2 rounded-lg animate-fade-in-up">
        <ul class="space-y-3">
            <li>
                <a href="{{ route('customer.dashboard') }}" 
                   class="block px-4 py-3 font-semibold hover:text-rose-gold transition-colors {{ request()->routeIs('customer.dashboard') ? 'text-rose-gold bg-cream-pastel' : 'text-dark-cocoa' }} rounded-lg">
                   <div class="flex items-center">
                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                       </svg>
                       Beranda
                   </div>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.products.index') }}" 
                   class="block px-4 py-3 font-semibold hover:text-rose-gold transition-colors {{ request()->routeIs('customer.products.*') ? 'text-rose-gold bg-cream-pastel' : 'text-dark-cocoa' }} rounded-lg">
                   <div class="flex items-center">
                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                       </svg>
                       Produk
                   </div>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.cart') }}" 
                   class="block px-4 py-3 font-semibold hover:text-rose-gold transition-colors {{ request()->routeIs('customer.cart') ? 'text-rose-gold bg-cream-pastel' : 'text-dark-cocoa' }} rounded-lg">
                   <div class="flex items-center justify-between">
                       <div class="flex items-center">
                           <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                           </svg>
                           Keranjang
                       </div>
                       @if($cartCount > 0)
                       <span class="bg-rose-gold text-white text-xs w-6 h-6 rounded-full flex items-center justify-center">
                           {{ $cartCount }}
                       </span>
                       @endif
                   </div>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.orders.index') }}" 
                   class="block px-4 py-3 font-semibold hover:text-rose-gold transition-colors {{ request()->routeIs('customer.orders.*') ? 'text-rose-gold bg-cream-pastel' : 'text-dark-cocoa' }} rounded-lg">
                   <div class="flex items-center">
                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                       </svg>
                       Pesanan
                   </div>
                </a>
            </li>
            
            <div class="border-t border-cream-pastel my-2"></div>
            
            <li>
                <a href="{{ route('profile.edit') }}" 
                   class="block px-4 py-3 font-semibold hover:text-rose-gold transition-colors {{ request()->routeIs('profile.edit') ? 'text-rose-gold bg-cream-pastel' : 'text-dark-cocoa' }} rounded-lg">
                   <div class="flex items-center">
                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                       </svg>
                       Profil Saya
                   </div>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full text-left px-4 py-3 font-semibold text-red-500 hover:bg-red-50 transition-colors rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </div>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- JavaScript untuk Mobile Menu -->
<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
    
    // Close mobile menu when clicking a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        if (window.scrollY > 50) {
            nav.classList.add('shadow-lg', 'backdrop-blur-sm', 'bg-white/95');
        } else {
            nav.classList.remove('shadow-lg', 'backdrop-blur-sm', 'bg-white/95');
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.relative.group');
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(event.target)) {
                const menu = dropdown.querySelector('.absolute');
                if (menu) {
                    menu.classList.remove('opacity-100', 'visible');
                    menu.classList.add('opacity-0', 'invisible');
                }
            }
        });
    });
</script>
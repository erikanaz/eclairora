<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Pastries - Éclairora</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Custom styles */
        .page-transition {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stagger-delay-1 { animation-delay: 0.1s; }
        .stagger-delay-2 { animation-delay: 0.2s; }
        .stagger-delay-3 { animation-delay: 0.3s; }
        .stagger-delay-4 { animation-delay: 0.4s; }
        
        /* Product hover effects */
        .product-hover {
            transition: all 0.3s ease;
        }
        
        .product-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(139, 90, 71, 0.15);
        }
        
        /* Filter animation */
        .filter-transition {
            transition: all 0.3s ease;
        }
        
        /* Category badges */
        .category-badge {
            transition: all 0.2s ease;
        }
        
        .category-badge:hover {
            transform: scale(1.05);
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #FFF4EB;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #D9A5A0;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #8C5A47;
        }
    </style>
</head>
<body class="font-sans bg-cream-pastel text-dark-cocoa">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm px-4 md:px-10 py-4 flex justify-between items-center">
        <a href="/" class="font-serif text-2xl md:text-3xl font-bold text-rose-gold tracking-wide hover:text-cocoa-brown transition-colors duration-300">
            Éclairora
        </a>
        
        <!-- Desktop Navigation -->
        <ul class="hidden md:flex items-center space-x-6">
            <li><a href="/" class="font-semibold hover:text-rose-gold transition-colors duration-300">Home</a></li>
            <li><a href="#categories" class="font-semibold text-rose-gold border-b-2 border-rose-gold transition-colors duration-300">Our Pastries</a></li>
            <li><a href="#about" class="font-semibold hover:text-rose-gold transition-colors duration-300">About</a></li>
            <li><a href="#contact" class="font-semibold hover:text-rose-gold transition-colors duration-300">Contact</a></li>
            <li><a href="/login" 
                   class="px-6 py-2 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 transform hover:-translate-y-0.5">
                   Login
                </a></li>
        </ul>
        
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-rose-gold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg px-4 py-4">
        <ul class="space-y-4">
            <li><a href="/" class="block font-semibold hover:text-rose-gold transition-colors">Home</a></li>
            <li><a href="#categories" class="block font-semibold text-rose-gold">Our Pastries</a></li>
            <li><a href="#about" class="block font-semibold hover:text-rose-gold transition-colors">About</a></li>
            <li><a href="#contact" class="block font-semibold hover:text-rose-gold transition-colors">Contact</a></li>
            <li><a href="/login" class="block text-center px-4 py-2 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-colors">Login</a></li>
        </ul>
    </div>

    <!-- Hero Section for Pastries -->
    <section class="relative bg-gradient-to-br from-rose-gold/10 to-lavender-mist py-16 md:py-24 px-4 md:px-10 overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-10 right-10 w-32 h-32 bg-gold/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-40 h-40 bg-rose-gold/10 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-6xl mx-auto text-center page-transition">
            <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-cocoa-brown mb-6">
                Our <span class="text-rose-gold">Exquisite</span> Pastries
            </h1>
            <p class="text-lg md:text-xl text-cocoa-brown max-w-3xl mx-auto mb-8">
                Discover our carefully curated collection of premium pastries, each crafted with passion and the finest ingredients to deliver an unforgettable experience.
            </p>
            <div class="flex justify-center">
                <a href="#categories" 
                   class="inline-flex items-center px-6 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl">
                   Explore Collection
                   <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                   </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Filter -->
    <section id="categories" class="py-12 px-4 md:px-10 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-serif text-3xl text-center text-dark-cocoa mb-8 page-transition stagger-delay-1">Pastry Categories</h2>
            
            <div class="flex flex-wrap justify-center gap-4 mb-12 page-transition stagger-delay-2">
                <button class="category-filter px-6 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 category-badge active" data-category="all">
                    All Pastries
                </button>
                <button class="category-filter px-6 py-3 bg-lavender-mist text-dark-cocoa font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 category-badge" data-category="eclair">
                    Éclairs
                </button>
                <button class="category-filter px-6 py-3 bg-lavender-mist text-dark-cocoa font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 category-badge" data-category="cream-puff">
                    Cream Puffs
                </button>
                <button class="category-filter px-6 py-3 bg-lavender-mist text-dark-cocoa font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 category-badge" data-category="tart">
                    Tarts
                </button>
                <button class="category-filter px-6 py-3 bg-lavender-mist text-dark-cocoa font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 category-badge" data-category="cake">
                    Cakes
                </button>
                <button class="category-filter px-6 py-3 bg-lavender-mist text-dark-cocoa font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 category-badge" data-category="special">
                    Special Edition
                </button>
            </div>
        </div>
    </section>

    <!-- Pastries Grid -->
    <section class="py-12 px-4 md:px-10">
        <div class="max-w-7xl mx-auto">
            <div id="pastries-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Pastry Item 1 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition stagger-delay-1" data-category="eclair">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1558319028-06c7a7b4160d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Classic Chocolate Éclair" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-rose-gold text-white text-sm font-semibold rounded-full">
                            Éclair
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Classic Chocolate Éclair</h3>
                        <p class="text-dark-cocoa mb-4">
                            Traditional French éclair filled with rich vanilla cream and topped with dark chocolate ganache.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$4.99</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pastry Item 2 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition stagger-delay-2" data-category="cream-puff">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1574085733277-851d9d856a3a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Vanilla Cream Puff" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-lavender-mist text-dark-cocoa text-sm font-semibold rounded-full">
                            Cream Puff
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Vanilla Cream Puff</h3>
                        <p class="text-dark-cocoa mb-4">
                            Light and airy choux pastry filled with luscious vanilla pastry cream, dusted with powdered sugar.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$3.99</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pastry Item 3 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition stagger-delay-3" data-category="tart">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Berry Medley Tart" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-gold text-dark-cocoa text-sm font-semibold rounded-full">
                            Tart
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Berry Medley Tart</h3>
                        <p class="text-dark-cocoa mb-4">
                            Buttery shortcrust filled with vanilla pastry cream and topped with fresh strawberries, blueberries, and raspberries.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$5.99</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pastry Item 4 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition stagger-delay-4" data-category="cake">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Red Velvet Cake Slice" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-rose-gold/20 text-cocoa-brown text-sm font-semibold rounded-full">
                            Cake
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Red Velvet Cake Slice</h3>
                        <p class="text-dark-cocoa mb-4">
                            Moist red velvet cake layered with creamy cheese frosting, finished with white chocolate curls.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$6.99</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pastry Item 5 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition" data-category="special">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1559620192-032c64bc86af?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Golden Pistachio Éclair" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-gold text-dark-cocoa text-sm font-semibold rounded-full">
                            Special Edition
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Golden Pistachio Éclair</h3>
                        <p class="text-dark-cocoa mb-4">
                            Limited edition éclair with pistachio cream filling, gold leaf decoration, and crushed pistachios.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$7.99</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pastry Item 6 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition" data-category="cream-puff">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Chocolate Hazelnut Cream Puff" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-lavender-mist text-dark-cocoa text-sm font-semibold rounded-full">
                            Cream Puff
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Chocolate Hazelnut Cream Puff</h3>
                        <p class="text-dark-cocoa mb-4">
                            Decadent cream puff filled with chocolate hazelnut cream and topped with roasted hazelnuts.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$4.99</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pastry Item 7 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition" data-category="tart">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Lemon Meringue Tart" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-gold text-dark-cocoa text-sm font-semibold rounded-full">
                            Tart
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Lemon Meringue Tart</h3>
                        <p class="text-dark-cocoa mb-4">
                            Tangy lemon curd in a buttery crust, topped with toasted Italian meringue.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$5.49</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pastry Item 8 -->
                <div class="product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition" data-category="cake">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Tiramisu Cake Slice" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 bg-rose-gold/20 text-cocoa-brown text-sm font-semibold rounded-full">
                            Cake
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Tiramisu Cake Slice</h3>
                        <p class="text-dark-cocoa mb-4">
                            Layers of coffee-soaked ladyfingers and mascarpone cream, dusted with cocoa powder.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">$6.49</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12 page-transition">
                <button id="load-more" class="px-8 py-3 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                    Load More Pastries
                </button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-24 px-4 md:px-10 bg-gradient-to-r from-rose-gold/10 to-lavender-mist">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-serif text-3xl md:text-4xl text-cocoa-brown mb-6 page-transition">
                Ready to Taste Excellence?
            </h2>
            <p class="text-lg md:text-xl text-cocoa-brown mb-8 page-transition stagger-delay-1">
                Visit our pastry shop or order online to experience the Éclairora difference.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 page-transition stagger-delay-2">
                <a href="/contact" 
                   class="px-8 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 transform hover:-translate-y-1">
                   Visit Our Shop
                </a>
                <a href="#contact" 
                   class="px-8 py-3 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                   Contact Us
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark-cocoa text-white py-8 px-4 md:px-10">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <a href="/" class="font-serif text-2xl font-bold text-rose-gold tracking-wide">Éclairora</a>
                    <p class="mt-2 text-sm text-cream-pastel/80">Premium Pastry & Delights</p>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="/" class="text-cream-pastel hover:text-rose-gold transition-colors">Home</a>
                    <a href="#categories" class="text-cream-pastel hover:text-rose-gold transition-colors">Our Pastries</a>
                    <a href="#about" class="text-cream-pastel hover:text-rose-gold transition-colors">About</a>
                    <a href="#contact" class="text-cream-pastel hover:text-rose-gold transition-colors">Contact</a>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-cream-pastel/20 text-center">
                <p>&copy; 2025 Éclairora. All rights reserved. | Crafted with <span class="text-rose-gold">❤️</span></p>
            </div>
        </div>
    </footer>

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
        
        // Category filtering functionality
        const filterButtons = document.querySelectorAll('.category-filter');
        const productItems = document.querySelectorAll('.product-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-rose-gold', 'text-white', 'hover:bg-cocoa-brown');
                    btn.classList.add('bg-lavender-mist', 'text-dark-cocoa', 'hover:bg-rose-gold', 'hover:text-white');
                });
                
                // Add active class to clicked button
                button.classList.remove('bg-lavender-mist', 'text-dark-cocoa', 'hover:bg-rose-gold', 'hover:text-white');
                button.classList.add('active', 'bg-rose-gold', 'text-white', 'hover:bg-cocoa-brown');
                
                const category = button.dataset.category;
                
                // Filter products
                productItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.classList.remove('hidden', 'opacity-0', 'scale-95');
                        item.classList.add('block', 'opacity-100', 'scale-100', 'filter-transition');
                        setTimeout(() => {
                            item.classList.remove('scale-95');
                        }, 10);
                    } else {
                        item.classList.add('hidden', 'opacity-0', 'scale-95', 'filter-transition');
                    }
                });
            });
        });
        
        // Add to cart functionality
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const productCard = button.closest('.product-item');
                const productName = productCard.querySelector('h3').textContent;
                const productPrice = productCard.querySelector('.text-rose-gold').textContent;
                
                // Animation effect
                button.classList.add('bg-rose-gold', 'text-white');
                button.textContent = 'Added!';
                
                // Show notification
                showNotification(`${productName} added to cart!`);
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    button.classList.remove('bg-rose-gold', 'text-white');
                    button.textContent = 'Add to Cart';
                }, 2000);
                
                // Here you would typically add to cart logic
                console.log(`Added to cart: ${productName} - ${productPrice}`);
            });
        });
        
        // Load more functionality
        const loadMoreButton = document.getElementById('load-more');
        let currentItems = 8;
        
        // Simulate more pastries data
        const morePastries = [
            {
                category: 'eclair',
                name: 'Raspberry Rose Éclair',
                description: 'Delicate rose cream filling with fresh raspberries, topped with rose glaze.',
                price: '$5.49',
                image: 'https://images.unsplash.com/photo-1547414368-ac947d00b91d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            },
            {
                category: 'special',
                name: 'Salted Caramel Delight',
                description: 'Salted caramel cream in choux pastry, finished with gold dust and sea salt flakes.',
                price: '$6.99',
                image: 'https://images.unsplash.com/photo-1568307977369-3d2b8c6c4a5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            },
            {
                category: 'tart',
                name: 'Chocolate Truffle Tart',
                description: 'Rich chocolate ganache in a chocolate crust, topped with cocoa nibs.',
                price: '$5.99',
                image: 'https://images.unsplash.com/photo-1578775887804-699de7086ff9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            },
            {
                category: 'cake',
                name: 'Matcha Green Tea Cake',
                description: 'Layers of matcha sponge cake with white chocolate matcha cream.',
                price: '$6.99',
                image: 'https://images.unsplash.com/photo-1562448079-4268d2c1aff6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            }
        ];
        
        loadMoreButton.addEventListener('click', () => {
            const container = document.getElementById('pastries-container');
            
            morePastries.forEach((pastry, index) => {
                const pastryElement = document.createElement('div');
                pastryElement.className = `product-item bg-white rounded-2xl overflow-hidden shadow-lg product-hover page-transition filter-transition opacity-0 scale-95`;
                pastryElement.dataset.category = pastry.category;
                
                setTimeout(() => {
                    pastryElement.classList.remove('opacity-0', 'scale-95');
                }, index * 100);
                
                pastryElement.innerHTML = `
                    <div class="relative h-64 overflow-hidden">
                        <img src="${pastry.image}" 
                             alt="${pastry.name}" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute top-4 left-4 px-3 py-1 ${
                            pastry.category === 'eclair' ? 'bg-rose-gold text-white' :
                            pastry.category === 'cream-puff' ? 'bg-lavender-mist text-dark-cocoa' :
                            pastry.category === 'tart' ? 'bg-gold text-dark-cocoa' :
                            pastry.category === 'cake' ? 'bg-rose-gold/20 text-cocoa-brown' :
                            'bg-gold text-dark-cocoa'
                        } text-sm font-semibold rounded-full">
                            ${pastry.category === 'eclair' ? 'Éclair' :
                              pastry.category === 'cream-puff' ? 'Cream Puff' :
                              pastry.category === 'tart' ? 'Tart' :
                              pastry.category === 'cake' ? 'Cake' : 'Special Edition'}
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-2xl text-cocoa-brown mb-2">${pastry.name}</h3>
                        <p class="text-dark-cocoa mb-4">${pastry.description}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-rose-gold">${pastry.price}</span>
                            <button class="add-to-cart px-4 py-2 bg-cream-pastel text-cocoa-brown font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                `;
                
                container.appendChild(pastryElement);
            });
            
            // Update current items count
            currentItems += morePastries.length;
            
            // Hide load more button if we've loaded all items
            if (currentItems >= 12) {
                loadMoreButton.classList.add('hidden');
                showNotification('All pastries loaded!');
            }
            
            // Re-attach event listeners to new buttons
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const productCard = button.closest('.product-item');
                    const productName = productCard.querySelector('h3').textContent;
                    const productPrice = productCard.querySelector('.text-rose-gold').textContent;
                    
                    button.classList.add('bg-rose-gold', 'text-white');
                    button.textContent = 'Added!';
                    
                    showNotification(`${productName} added to cart!`);
                    
                    setTimeout(() => {
                        button.classList.remove('bg-rose-gold', 'text-white');
                        button.textContent = 'Add to Cart';
                    }, 2000);
                    
                    console.log(`Added to cart: ${productName} - ${productPrice}`);
                });
            });
        });
        
        // Notification function
        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-rose-gold text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full opacity-0 transition-all duration-300';
            notification.textContent = message;
            notification.id = 'notification';
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.remove('translate-x-full', 'opacity-0');
                notification.classList.add('translate-x-0', 'opacity-100');
            }, 10);
            
            // Hide notification after 3 seconds
            setTimeout(() => {
                notification.classList.remove('translate-x-0', 'opacity-100');
                notification.classList.add('translate-x-full', 'opacity-0');
                
                // Remove from DOM after animation
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Initialize page transitions
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.page-transition');
            animatedElements.forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
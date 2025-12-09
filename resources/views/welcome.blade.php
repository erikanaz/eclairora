<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éclairora - Premium Pastry</title>
    <!-- Load Tailwind CSS from your Laravel setup -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for scrollbar and animations */
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
        
        /* Custom animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="font-sans bg-cream-pastel text-dark-cocoa">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm px-4 md:px-10 py-4 flex justify-between items-center">
        <div class="font-serif text-2xl md:text-3xl font-bold text-rose-gold tracking-wide">Éclairora</div>
        
        <!-- Desktop Navigation -->
        <ul class="hidden md:flex items-center space-x-6">
            <li><a href="#products" class="font-semibold hover:text-rose-gold transition-colors duration-300">Products</a></li>
            <li><a href="#about" class="font-semibold hover:text-rose-gold transition-colors duration-300">About</a></li>
            <li><a href="#contact" class="font-semibold hover:text-rose-gold transition-colors duration-300">Contact</a></li>
            <li><a href="/login" 
                   class="px-6 py-2 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 transform hover:-translate-y-0.5">
                   Login
                </a></li>
            <li><a href="/register" 
                   class="px-6 py-2 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-all duration-300">
                   Register
                </a></li>
        </ul>
        
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-rose-gold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </nav>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg px-4 py-4">
        <ul class="space-y-4">
            <li><a href="#products" class="block font-semibold hover:text-rose-gold transition-colors">Products</a></li>
            <li><a href="#about" class="block font-semibold hover:text-rose-gold transition-colors">About</a></li>
            <li><a href="#contact" class="block font-semibold hover:text-rose-gold transition-colors">Contact</a></li>
            <li><a href="/login" class="block text-center px-4 py-2 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-colors">Login</a></li>
            <li><a href="/register" class="block text-center px-4 py-2 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors">Register</a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-cream-pastel to-lavender-mist py-16 md:py-24 px-4 md:px-10 text-center">
        <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-rose-gold mb-4 animate-fade-in-up">Éclairora</h1>
        <p class="text-lg md:text-xl text-cocoa-brown max-w-3xl mx-auto mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
            Where Every Bite Shines. Premium pastries crafted to delight your senses.
        </p>
        <a href="#products" class="inline-block px-8 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl animate-fade-in-up" style="animation-delay: 0.2s">
            Shop Now
        </a>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-16 md:py-20 px-4 md:px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Eclair Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('images/eclair.png') }}" alt="Eclair" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Eclair</h3>
                    <p class="text-dark-cocoa">Classic French pastry with creamy filling.</p>
                </div>
            </div>

            <!-- Cream Puff Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.1s">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('images/cream-puff.png') }}" alt="Cream Puff" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Cream Puff</h3>
                    <p class="text-dark-cocoa">Soft and fluffy, filled with rich cream.</p>
                </div>
            </div>

            <!-- Mini Tart Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('images/mini-tart.png') }}" alt="Mini Tart" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Mini Tart</h3>
                    <p class="text-dark-cocoa">Delicate pastry with sweet toppings.</p>
                </div>
            </div>

            <!-- Cake Slice Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.3s">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('images/cake-slice.png') }}" alt="Cake Slice" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-serif text-2xl text-cocoa-brown mb-2">Cake Slice</h3>
                    <p class="text-dark-cocoa">Premium slice of cake for special moments.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 md:py-20 px-4 md:px-10 bg-gradient-to-b from-lavender-mist to-cream-pastel">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-serif text-3xl md:text-4xl text-rose-gold mb-8">About Éclairora</h2>
            <p class="text-lg md:text-xl text-cocoa-brown leading-relaxed">
                Éclairora is dedicated to crafting premium pastries with love and passion. Our menu features exquisite eclairs, cream puffs, tarts, and cake slices. Each piece is carefully designed to delight your senses and make every moment special. Experience the perfect balance of flavor, texture, and elegance in every bite.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 md:py-20 px-4 md:px-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-serif text-3xl md:text-4xl text-rose-gold mb-8">Contact Us</h2>
            <p class="text-lg md:text-xl text-cocoa-brown mb-8 max-w-2xl mx-auto">
                Have questions or want to place an order? Reach out to us through email or visit us at our pastry shop. We are happy to assist you!
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <!-- Using your button component styles -->
                <a href="mailto:info@eclairora.com" 
                   class="inline-block px-6 py-2 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                   Email Us
                </a>
                <a href="/contact" 
                   class="inline-block px-6 py-2 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300">
                   Visit Us
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark-cocoa text-white py-8 px-4 md:px-10 text-center">
        <p>&copy; 2025 Éclairora. All rights reserved. | Designed with <span class="text-rose-gold">❤️</span></p>
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
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg', 'backdrop-blur-sm', 'bg-white/95');
            } else {
                nav.classList.remove('shadow-lg', 'backdrop-blur-sm', 'bg-white/95');
            }
        });
        
        // Add animation to elements when they come into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    observer.unobserve(entry.target); // Stop observing after animation
                }
            });
        }, observerOptions);
        
        // Observe product cards
        document.querySelectorAll('.product-card').forEach(card => {
            observer.observe(card);
        });
        
        // Initialize animations for elements that are already in view
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.animate-fade-in-up');
            animatedElements.forEach(element => {
                const rect = element.getBoundingClientRect();
                const isVisible = (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
                
                if (isVisible) {
                    element.classList.add('animate-fade-in-up');
                } else {
                    observer.observe(element);
                }
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éclairora - Premium Pastry</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* ===== Palet Warna Brand ===== */
        :root {
            --cream-pastel: #FFF4EB;
            --rose-gold: #D9A5A0;
            --cocoa-brown: #8C5A47;
            --lavender-mist: #E6DFF5;
            --gold: #DDBB67;
            --dark-cocoa: #3B2A26;
            --white: #FFFFFF;
        }

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream-pastel);
            color: var(--dark-cocoa);
        }

        /* ===== Navbar ===== */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--rose-gold);
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--dark-cocoa);
            font-weight: 600;
            transition: 0.3s;
        }

        nav ul li a:hover {
            color: var(--rose-gold);
        }

        /* Tombol navbar */
        .btn-nav {
            padding: 0.5rem 1.5rem;
            background-color: var(--rose-gold);
            color: var(--white);
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-nav:hover {
            background-color: var(--cocoa-brown);
        }

        .btn-nav-outline {
            padding: 0.5rem 1.5rem;
            border: 2px solid var(--rose-gold);
            color: var(--rose-gold);
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-nav-outline:hover {
            background-color: var(--rose-gold);
            color: var(--white);
        }

        /* ===== Hero Section ===== */
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 5rem 5% 5rem;
            background: linear-gradient(to bottom, var(--cream-pastel), var(--lavender-mist));
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--rose-gold);
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--cocoa-brown);
            margin-bottom: 2rem;
        }

        .hero .btn {
            padding: 0.8rem 2rem;
            background-color: var(--rose-gold);
            color: var(--white);
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .hero .btn:hover {
            background-color: var(--cocoa-brown);
        }

        /* ===== Product Section ===== */
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 5rem 5%;
        }

        .product-card {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            text-align: center;
            transition: 0.3s;
        }

        .product-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px 10px 0 0; /* opsional */
        }

        .product-card h3 {
            margin: 1rem 0 0.5rem;
            color: var(--cocoa-brown);
            font-family: 'Playfair Display', serif;
        }

        .product-card p {
            color: var(--dark-cocoa);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* ===== Footer ===== */
        footer {
            background-color: var(--dark-cocoa);
            color: var(--white);
            text-align: center;
            padding: 2rem 5%;
        }

        footer a {
            color: var(--rose-gold);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">Éclairora</div>
        <ul>
            <li><a href="#products">Products</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="/login" class="btn-nav">Login</a></li>
            <li><a href="/register" class="btn-nav-outline">Register</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Éclairora</h1>
        <p>Where Every Bite Shines. Premium pastries crafted to delight your senses.</p>
        <a href="#products" class="btn">Shop Now</a>
    </section>

    <!-- Products Section -->
    <section id="products" class="products">
        <div class="product-card">
            <img src="{{ asset('images/eclair.png') }}" alt="Eclair">
            <h3>Eclair</h3>
            <p>Classic French pastry with creamy filling.</p>
        </div>
        <div class="product-card">
            <img src="{{ asset('images/cream-puff.png') }}" alt="Cream Puff">
            <h3>Cream Puff</h3>
            <p>Soft and fluffy, filled with rich cream.</p>
        </div>
        <div class="product-card">
            <img src="{{ asset('images/mini-tart.png') }}" alt="Mini Tart">
            <h3>Mini Tart</h3>
            <p>Delicate pastry with sweet toppings.</p>
        </div>
        <div class="product-card">
            <img src="{{ asset('images/cake-slice.png') }}" alt="Cake Slice">
            <h3>Cake Slice</h3>
            <p>Premium slice of cake for special moments.</p>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" style="padding:5rem 5%; 
        background: linear-gradient(to bottom, var(--lavender-mist), var(--cream-pastel)); 
        text-align:center;">
        <h2 style="font-family:'Playfair Display', serif; font-size:2.5rem; margin-bottom:2rem; color:var(--rose-gold);">About Éclairora</h2>
        <p style="max-width:700px; margin:0 auto; color:var(--cocoa-brown); font-size:1.1rem; line-height:1.8;">
            Éclairora is dedicated to crafting premium pastries with love and passion. Our menu features exquisite eclairs, cream puffs, tarts, and cake slices. Each piece is carefully designed to delight your senses and make every moment special. Experience the perfect balance of flavor, texture, and elegance in every bite.
        </p>
    </section>

    <!-- Contact Section -->
    <section id="contact" style="padding:5rem 5%; text-align:center;">
        <h2 style="font-family:'Playfair Display', serif; font-size:2.5rem; margin-bottom:2rem; color:var(--rose-gold);">Contact Us</h2>
        <p style="max-width:700px; margin:0 auto 2rem; color:var(--cocoa-brown); font-size:1.1rem; line-height:1.6;">
            Have questions or want to place an order? Reach out to us through email or visit us at our pastry shop. We are happy to assist you!
        </p>
        <div style="display:flex; justify-content:center; gap:1rem; flex-wrap:wrap;">
            <a href="mailto:info@eclairora.com" class="btn" style="margin-bottom:1rem;">Email Us</a>
            <a href="/contact" class="btn-nav-outline" style="margin-bottom:1rem;">Visit Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Éclairora. All rights reserved. | Designed with ❤️</p>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Éclairora</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-cream-pastel to-lavender-mist min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <!-- Decorative top border -->
        <div class="h-2 bg-gradient-to-r from-rose-gold to-gold"></div>
        
        <div class="p-8">
            <!-- Logo -->
            <div class="text-center mb-6">
                <h1 class="font-serif text-4xl font-bold text-rose-gold mb-2">Éclairora</h1>
                <p class="text-cocoa-brown font-semibold text-sm">Premium Pastry & Delights</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
            <div class="mb-6 p-4 bg-light-rose border-l-4 border-rose-gold text-cocoa-brown rounded-lg">
                {{ session('status') }}
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-dark-cocoa font-semibold mb-2">
                        Email Address
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="pastrylover@example.com"
                        class="w-full px-4 py-3 border-2 border-lavender-mist rounded-xl focus:border-rose-gold focus:ring-2 focus:ring-rose-gold/20 focus:outline-none transition-all duration-300 bg-cream-pastel/50"
                    />
                    
                    @error('email')
                    <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-dark-cocoa font-semibold mb-2">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="w-full px-4 py-3 border-2 border-lavender-mist rounded-xl focus:border-rose-gold focus:ring-2 focus:ring-rose-gold/20 focus:outline-none transition-all duration-300 bg-cream-pastel/50"
                    />
                    
                    @error('password')
                    <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-end mr-3">
                    {{-- <label class="flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-lavender-mist text-rose-gold focus:ring-rose-gold/20"
                        />
                        <span class="ml-2 text-sm text-cocoa-brown">Remember me</span>
                    </label> --}}

                    @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-rose-gold font-semibold hover:text-cocoa-brown transition-colors"
                    >
                        Forgot password?
                    </a>
                    @endif
                </div>

                <!-- Submit Button menggunakan komponen button.blade.php -->
                <x-button type="submit" variant="primary" class="w-full justify-center py-3 rounded-xl transform hover:-translate-y-0.5 transition-all duration-300 shadow-lg hover:shadow-xl">
                    Log In
                </x-button>

                <!-- Back to Home -->
                {{-- <div class="text-center">
                    <a
                        href="/"
                        class="inline-flex items-center text-sm text-cocoa-brown font-semibold hover:text-rose-gold transition-colors"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Home
                    </a>
                </div> --}}
            </form>

            <!-- Register Link -->
            <div class="mt-8 pt-6 border-t border-lavender-mist text-center">
                <p class="text-cocoa-brown">
                    Don't have an account?
                    <a
                        href="{{ route('register') }}"
                        class="text-rose-gold font-bold hover:text-cocoa-brown transition-colors ml-1"
                    >
                        Register Now
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Optional: Add some decorative pastry icons -->
    <div class="fixed -bottom-20 -right-20 w-64 h-64 bg-rose-gold/10 rounded-full blur-3xl"></div>
    <div class="fixed -top-20 -left-20 w-64 h-64 bg-gold/10 rounded-full blur-3xl"></div>
</body>
</html>
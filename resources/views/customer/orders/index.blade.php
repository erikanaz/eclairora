<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 md:px-6 py-2">
        <!-- Header -->
        <div class="text-center mb-12 animate-fade-in-up">
            <h1 class="font-serif text-3xl md:text-4xl text-rose-gold mb-4">
                Riwayat Pesanan
            </h1>
            <p class="text-lg text-cocoa-brown max-w-2xl mx-auto">
                Semua pesanan Anda dalam satu tempat
            </p>
        </div>

        <!-- Notification -->
        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-xl animate-fade-in-up">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if($orders->count() > 0)
        <!-- Orders List - 1 card per baris -->
        <div class="space-y-6">
            @foreach($orders as $order)
            <!-- Order Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 animate-fade-in-up">
                <!-- Card Header -->
                <div class="p-6 border-b border-cream-pastel">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <h3 class="font-serif text-xl text-cocoa-brown">
                                    #{{ $order->order_number ?? 'ORD-' . $order->id }}
                                </h3>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'processing' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                        'shipped' => 'bg-purple-100 text-purple-800 border border-purple-200',
                                        'delivered' => 'bg-green-100 text-green-800 border border-green-200',
                                        'cancelled' => 'bg-red-100 text-red-800 border border-red-200'
                                    ];
                                    $statusTexts = [
                                        'pending' => 'Menunggu Pembayaran',
                                        'processing' => 'Sedang Diproses',
                                        'shipped' => 'Dalam Pengiriman',
                                        'delivered' => 'Pesanan Selesai',
                                        'cancelled' => 'Dibatalkan'
                                    ];
                                @endphp
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200' }}">
                                    {{ $statusTexts[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </div>
                            
                            <!-- Order Meta -->
                            <div class="flex flex-wrap gap-4 text-sm text-dark-cocoa">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-rose-gold mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $order->created_at->format('d M Y') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-rose-gold mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    {{ $order->items->count() }} item
                                </div>
                                @if($order->payment_method)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-rose-gold mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Total Price -->
                        <div class="text-right">
                            <p class="text-2xl font-bold text-rose-gold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-cocoa-brown mt-1">
                                {{ $order->items->sum('quantity') }} pcs
                            </p>
                        </div>
                    </div>
                    
                    <!-- Shipping Address -->
                    @if($order->shipping_address)
                    <div class="flex items-start text-sm text-dark-cocoa bg-cream-pastel/30 p-3 rounded-lg">
                        <svg class="w-4 h-4 text-rose-gold mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ Str::limit($order->shipping_address, 80) }}</span>
                    </div>
                    @endif
                </div>
                
                <!-- Order Items -->
                <div class="p-6">
                    <h4 class="font-medium text-cocoa-brown mb-4 flex items-center">
                        <svg class="w-5 h-5 text-rose-gold mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Item Pesanan
                    </h4>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center p-3 hover:bg-cream-pastel/20 rounded-lg transition-colors">
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image ? asset('images/' . $item->product->image) : asset('images/default-pastry.png') }}" 
                                     alt="{{ $item->product->name }}"
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null; this.src='{{ asset('images/default-pastry.png') }}'">
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h5 class="font-medium text-cocoa-brown">{{ $item->product->name }}</h5>
                                        <p class="text-sm text-dark-cocoa mt-1">
                                            {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <p class="font-semibold text-cocoa-brown">
                                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Card Footer -->
                <div class="px-6 py-4 bg-cream-pastel/20 border-t border-cream-pastel">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-dark-cocoa">
                            @if($order->notes)
                            <div class="flex items-start">
                                <svg class="w-4 h-4 text-rose-gold mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <span class="italic">{{ Str::limit($order->notes, 60) }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="flex gap-3">
                            @if($order->status === 'pending')
                            <button class="px-5 py-2.5 bg-rose-gold text-white text-sm font-medium rounded-full hover:bg-cocoa-brown transition-colors duration-300 flex items-center pay-btn"
                                    data-order-id="{{ $order->id }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Bayar Pesanan
                            </button>
                            @endif
                            <a href="{{ route('customer.orders.show', $order->id) }}" 
                               class="px-5 py-2.5 border border-rose-gold text-rose-gold text-sm font-medium rounded-full hover:bg-rose-gold hover:text-white transition-colors duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Order Stats -->
        {{-- <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 animate-fade-in-up" style="animation-delay: 0.3s">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-cream-pastel">
                <p class="text-2xl font-bold text-rose-gold text-center">{{ $orders->count() }}</p>
                <p class="text-sm text-cocoa-brown text-center mt-1">Total Pesanan</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-cream-pastel">
                <p class="text-2xl font-bold text-rose-gold text-center">
                    Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}
                </p>
                <p class="text-sm text-cocoa-brown text-center mt-1">Total Belanja</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-cream-pastel">
                <p class="text-2xl font-bold text-rose-gold text-center">
                    {{ $orders->where('status', 'pending')->count() }}
                </p>
                <p class="text-sm text-cocoa-brown text-center mt-1">Menunggu</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-cream-pastel">
                <p class="text-2xl font-bold text-rose-gold text-center">
                    {{ $orders->where('status', 'delivered')->count() }}
                </p>
                <p class="text-sm text-cocoa-brown text-center mt-1">Selesai</p>
            </div>
        </div> --}}
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16 animate-fade-in-up">
            <div class="w-40 h-40 mx-auto mb-8 relative">
                <div class="absolute inset-0 bg-gradient-to-br from-rose-gold/10 to-lavender-mist/10 rounded-full"></div>
                <div class="absolute inset-8 bg-gradient-to-br from-rose-gold/5 to-lavender-mist/5 rounded-full"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-24 h-24 text-rose-gold/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
            
            <h3 class="font-serif text-2xl text-cocoa-brown mb-4">Belum ada pesanan</h3>
            <p class="text-dark-cocoa mb-8 max-w-sm mx-auto">
                Yuk, mulai petualangan rasa Anda dengan pastry premium kami!
            </p>
            
            <a href="{{ route('customer.products.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition-all duration-300 shadow-md hover:shadow-lg group">
                <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Mulai Belanja
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

        <!-- Back to Shop -->
        {{-- <div class="mt-12 text-center animate-fade-in-up" style="animation-delay: 0.4s">
            <a href="{{ route('customer.products.index') }}" 
               class="inline-flex items-center text-rose-gold hover:text-cocoa-brown transition-colors duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Katalog Produk
            </a>
        </div> --}}
    </div>

    <!-- Payment Modal -->
    <div id="payment-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full animate-fade-in-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-serif text-xl text-cocoa-brown">Bayar Pesanan</h3>
                    <button id="close-modal" class="text-cocoa-brown hover:text-rose-gold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div id="payment-content" class="space-y-4">
                    <!-- Content akan diisi JavaScript -->
                </div>
                
                <div class="mt-6 pt-6 border-t border-cream-pastel flex justify-end gap-3">
                    <button id="cancel-payment" 
                            class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Nanti Saja
                    </button>
                    <button id="confirm-payment" 
                            class="px-4 py-2 text-sm bg-rose-gold text-white rounded-lg hover:bg-cocoa-brown transition-colors">
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
        
    </div>
    

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment modal logic
        const paymentModal = document.getElementById('payment-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelPayment = document.getElementById('cancel-payment');
        let currentOrderId = null;

        // Show payment modal
        document.querySelectorAll('.pay-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                currentOrderId = this.getAttribute('data-order-id');
                
                const orderCard = this.closest('.bg-white');
                const orderNumber = orderCard.querySelector('.font-serif')?.textContent || '';
                const totalPrice = orderCard.querySelector('.text-2xl')?.textContent || '';
                
                document.getElementById('payment-content').innerHTML = `
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 mx-auto mb-3 bg-rose-gold/10 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-rose-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <p class="text-sm text-cocoa-brown">${orderNumber}</p>
                        <p class="text-xl font-bold text-rose-gold mt-1">${totalPrice}</p>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-cream-pastel rounded-lg hover:border-rose-gold transition-colors cursor-pointer">
                            <input type="radio" name="payment-method" value="bca" class="mr-3" checked>
                            <div>
                                <div class="font-medium text-cocoa-brown">Transfer Bank - BCA</div>
                                <div class="text-xs text-dark-cocoa mt-1">123-456-7890 (Éclairora Pastry)</div>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-3 border border-cream-pastel rounded-lg hover:border-rose-gold transition-colors cursor-pointer">
                            <input type="radio" name="payment-method" value="mandiri" class="mr-3">
                            <div>
                                <div class="font-medium text-cocoa-brown">Transfer Bank - Mandiri</div>
                                <div class="text-xs text-dark-cocoa mt-1">987-654-3210 (Éclairora Pastry)</div>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-3 border border-cream-pastel rounded-lg hover:border-rose-gold transition-colors cursor-pointer">
                            <input type="radio" name="payment-method" value="cod" class="mr-3">
                            <div>
                                <div class="font-medium text-cocoa-brown">Cash on Delivery (COD)</div>
                                <div class="text-xs text-dark-cocoa mt-1">Bayar saat barang diterima</div>
                            </div>
                        </label>
                    </div>
                    
                    <div class="mt-4 p-3 bg-cream-pastel/30 rounded-lg">
                        <p class="text-xs text-dark-cocoa">
                            <span class="font-medium text-rose-gold">Catatan:</span> Upload bukti pembayaran di halaman detail pesanan setelah transfer.
                        </p>
                    </div>
                `;
                
                paymentModal.classList.remove('hidden');
                paymentModal.classList.add('flex');
            });
        });

        // Close modal
        function closePaymentModal() {
            paymentModal.classList.add('hidden');
            paymentModal.classList.remove('flex');
            currentOrderId = null;
        }

        closeModal.addEventListener('click', closePaymentModal);
        cancelPayment.addEventListener('click', closePaymentModal);
        paymentModal.addEventListener('click', function(e) {
            if (e.target === this) closePaymentModal();
        });

        // Confirm payment
        document.getElementById('confirm-payment').addEventListener('click', function() {
            if (!currentOrderId) return;
            
            const originalText = this.innerHTML;
            this.innerHTML = `
                <div class="flex items-center justify-center">
                    <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></div>
                    Memproses...
                </div>
            `;
            this.disabled = true;
            
            // Simulate payment processing
            setTimeout(() => {
                // Show success notification
                showNotification('Pembayaran berhasil dikonfirmasi!', 'success');
                
                // Update the order card
                const orderCard = document.querySelector(`.pay-btn[data-order-id="${currentOrderId}"]`)?.closest('.bg-white');
                if (orderCard) {
                    // Update status badge
                    const statusBadge = orderCard.querySelector('.px-3');
                    if (statusBadge) {
                        statusBadge.textContent = 'Sedang Diproses';
                        statusBadge.className = 'px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200';
                    }
                    
                    // Update pay button
                    const payButton = orderCard.querySelector('.pay-btn');
                    if (payButton) {
                        payButton.innerHTML = `
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menunggu Konfirmasi
                        `;
                        payButton.classList.remove('bg-rose-gold', 'hover:bg-cocoa-brown');
                        payButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                        payButton.disabled = true;
                    }
                }
                
                closePaymentModal();
                
                // Reset button
                this.innerHTML = originalText;
                this.disabled = false;
            }, 1500);
        });

        // Notification function
        function showNotification(message, type = 'success') {
            const container = document.getElementById('notification-container');
            if (!container) {
                const newContainer = document.createElement('div');
                newContainer.id = 'notification-container';
                newContainer.className = 'fixed top-4 right-4 z-50 space-y-2';
                document.body.appendChild(newContainer);
                container = newContainer;
            }
            
            const notification = document.createElement('div');
            notification.className = `px-4 py-3 rounded-lg shadow-lg animate-fade-in-up ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${type === 'success' ? 
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />' :
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.47 16.5c-.77.833.192 2.5 1.732 2.5z" />'
                        }
                    </svg>
                    <span class="text-sm">${message}</span>
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
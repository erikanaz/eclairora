@props([
    'variant' => 'primary', // primary / outline
])

@php
$classes = match($variant) {
    'primary' => 'px-6 py-2 bg-rose-gold text-white font-semibold rounded-full hover:bg-cocoa-brown transition',
    'outline' => 'px-6 py-2 border-2 border-rose-gold text-rose-gold font-semibold rounded-full hover:bg-rose-gold hover:text-white transition',
};
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>

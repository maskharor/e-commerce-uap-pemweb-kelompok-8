@props(['value'])

@php
    $numeric = preg_replace('/[^0-9]/', '', (string) ($value ?? 0));
    $formatted = 'Rp ' . number_format((int) $numeric, 0, ',', '.');
@endphp

<span {{ $attributes->merge(['class' => '']) }}>{{ $formatted }}</span>
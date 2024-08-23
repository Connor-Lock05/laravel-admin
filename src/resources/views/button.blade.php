@props(['label', 'href' => null, 'onclick' => null, 'danger' => false, 'submit' => false])

@php
    $classes = [
        $danger ? 'bg-red-500' : 'bg-blue-500',
        'px-2',
        'py-1',
        'rounded-full',
        'text-white'
    ];
@endphp

@isset($onclick)
    <button type="{{ $submit ? 'submit' : 'button' }}" class="{{ implode(' ', $classes) }}" onclick="{{ $onclick }}">
        {{ $label }}
    </button>
@elseif(isset($href))
    <a class="{{ implode(' ', $classes) }}" href="{{ $href }}">
        {{ $label }}
    </a>
@endisset

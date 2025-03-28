@props(['background' => 'blue', 'color' => 'white'])

<button {{ $attributes->merge(['class' => "px-4 py-2 rounded-md font-medium transition-colors duration-200 bg-{$background}-500 text-{$color} hover:bg-{$background}-600"]) }}>
    {{ $slot }}
</button>

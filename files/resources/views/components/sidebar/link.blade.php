@props(['active'])
<a {{ $attributes->class(['flex items-center px-4 py-2 rounded-md', 'text-gray-600 bg-gray-200' => $active, 'text-gray-100 hover:bg-gray-200 hover:text-gray-600' => ! $active]) }}>
    <span class="mx-4 font-medium">{{ $slot }}</span>
</a>

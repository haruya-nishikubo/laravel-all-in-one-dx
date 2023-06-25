<div class="flex items-center mb-4">
    <label>
        <input {{ $attributes->merge(['type' => 'checkbox', 'class' => 'w-4 h-4 text-info-600 bg-gray-100 border-gray-300 rounded focus:ring-info-500 focus:ring-2']) }} />
        <span class="ml-2 text-sm font-medium text-gray-900">{{ $title }}</span>
    </label>
</div>

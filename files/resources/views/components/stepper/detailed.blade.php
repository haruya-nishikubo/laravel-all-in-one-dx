<div class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0">
    <ul class="grid grid-cols-3 gap-4">
    @foreach($items as $item)
        <li @class(['flex items-center text-info-600 space-x-2.5', 'text-info-600' => $item['is_active'], 'text-dark-400' => (! $item['is_active'])])>
            <span @class(['flex items-center justify-center w-8 h-8 border border-info-600 rounded-full shrink-0', 'border-info-600' => $item['is_active'], 'border-dark-500' => (! $item['is_active'])])>
                {{ $loop->iteration }}
            </span>
            <span>
                <h3 class="font-medium leading-tight">{{ $item['name'] }}</h3>
                <p class="text-sm">{{ $item['description'] }}</p>
            </span>
        </li>
    @endforeach
    </ul>
</div>

<label class="relative inline-flex items-center cursor-pointer">
    <input type="hidden" name="{{ $attributes->get('name') }}" value="{{ $no ?? 0 }}" />
    <input type="checkbox" name="{{ $attributes->get('name') }}"  value="{{ $yes ?? 1 }}" class="sr-only peer" @checked($checked ?? false) @disabled($disabled ?? false) />
    <div class="w-12 h-6 bg-dark-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-info-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-light-100 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-light-100 after:border-dark-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-info-600"></div>
    <span class="ml-4 text-sm font-bold">{{ $slot }}</span>
</label>


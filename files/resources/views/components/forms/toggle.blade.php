<label class="relative inline-flex items-center cursor-pointer">
    <input type="hidden" name="{{ $attributes->get('name') }}" value="0" />
    <input type="checkbox" name="{{ $attributes->get('name') }}"  value="1" class="sr-only peer" @checked($checked)>
    <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
    <span class="ml-4 text-sm font-bold">{{ $slot }}</span>
</label>


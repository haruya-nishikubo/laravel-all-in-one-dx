<button {{ $attributes->class(['inline-block px-6 py-3 rounded-md font-medium tracking-wide bg-red-600 text-white hover:bg-red-500'])->merge(['type' => 'submit']) }}>{{ $slot }}</button>

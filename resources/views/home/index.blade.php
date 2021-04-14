<x-home-layout>
    <div>
        <product-search
            :manufacturers="{{ $manufacturers }}"
            :categories="{{ $categories }}">
        </product-search>
    </div>

    <div class="flex-grow mt-4">
        <nearest-shops></nearest-shops>
        <latest-deals></latest-deals>
    </div>

    @if(auth()->user())
    <div class="md:flex md:flex-row md:justify-end pt-3 border-t border-gray-200 md:border-none">
        <a href="{{ route('product.create') }}" class="inline-block w-full md:w-40 bg-indigo-700 text-white text-center py-2 mb-4 rounded-sm">Új akciót láttam</a>
    </div>
    @else
    <div class="md:flex md:flex-row md:justify-center pt-3 border-t border-gray-200">
        <span class="flex flex-row w-full justify-center space-x-1 text-gray-900 text-center py-2 mb-4">
            <span>Új akciót láttál?</span>
            <a href="{{ route('login') }}" class="text-indigo-800 font-semibold">
                Jelentkezz be!
            </a>
        </span>
    </div>
    @endif
</x-home-layout>

<x-product-layout>
    <div class="flex-grow flex flex-col bg-white rounded-sm shadow-sm p-4 relative">
        @if (Auth::check())
            
        <form
        method="POST"
        action="{{ route('shoppingList.update', ['id' => $price->id]) }}"
        class="absolute bottom-3 right-6">
        @csrf
        @method('put')
        <button type="submit"
            class="flex flex-row space-x-2 items-center justify-center py-2 px-2 hover:bg-indigo-100 rounded-sm">
            <span class="text-indigo-800 hidden md:block">Hozzáadás a Kedvencekhez</span>
            <x-icons.heart-icon
                :productId="$price->id"
                :shoppingList="$shoppingList">
            </x-icons.heart-icon>
        </button>
    </form>
        @endif
        <h1 class="text-indigo-700 text-center text-lg font-semibold mb-6">
            {{ $price->product->name }}
        </h1>
        <div class="flex flex-row md:flex-col border-t border-gray-100 py-3">
            <div class="flex-grow text-gray-700 font-semibold">Ár</div>
            <div class="text-indigo-700 font-semibold">{{ $price->price }} {{ $price->currency->name }} / {{ $price->quantity }} {{ $price->per }}</div>
        </div>
        <div class="flex flex-row md:flex-col border-t border-gray-100 py-3">
            <div class="flex-grow font-semibold text-gray-700">Gyártja</div>
            <div class="text-gray-700">{{ $price->product->manufacturer->name }}</div>
        </div>
        <div class="flex flex-row md:flex-col border-t border-gray-100 py-3">
            <div class="flex-grow font-semibold text-gray-700">Kategóriák</div>
            <div class="text-gray-700 text-right">
                @foreach ($price->product->category->ancestorsAndSelf as $category)
                    {{ $category->name }} <br/>
                @endforeach
            </div>
        </div>
        <div class="flex flex-row md:flex-col border-t border-gray-100 py-3 border-b">
            <div class="flex-grow font-semibold text-gray-700">Bolt</div>
            <div class="text-gray-700 text-right">
                {{ $price->shop->name->name }}, <br>
                {{ $price->shop->address->postalCode->code }}, 
                {{ $price->shop->address->postalCode->city->name }} <br>
                {{ $price->shop->address->street }}
                {{ $price->shop->address->house }}
                
                
            </div>
        </div>
    </div>
    <div class="flex flex-row mb-4 mt-4 md:justify-end">
        <a href="{{ url()->previous() }}"
            class="bg-indigo-700 text-white w-full md:w-32 items-center justify-center space-x-2 py-2 rounded-sm shadow sm flex flex-row">
            <x-icons.back-icon></x-icons.back-icon>
            <span>Vissza</span>
        </a>
    </div>
</x-product-layout>
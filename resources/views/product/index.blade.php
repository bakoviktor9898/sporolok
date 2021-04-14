<x-product-layout>
    <div class="mb-6">
        <product-search
            search-text="{{ $searchText }}"
            :manufacturers="{{ $manufacturers }}"
            :categories="{{ $categories }}">
        </product-search>
    </div>
    <h3 class="mb-3 text-indigo-800 text-xl ml-1">{{ $products->count() }} találat</h3>
    <div class="flex flex-col md:flex-row md:flex-wrap md:justify-start">

        @foreach($products as $price)
        <x-product.card :productId="$price->id"
            :shoppingList="$shoppingList">
            <x-slot name="name">
                {{ $price->product->name }}
            </x-slot>
            <x-slot name="manufacturer">
                {{ $price->product->manufacturer->name }}
            </x-slot>
            <x-slot name="quantity">
                {{ $price->quantity }} {{ $price->per }}
            </x-slot>
            <x-slot name="shop">
                {{ $price->shop->name->name }},
                {{ $price->shop->address->postalCode->city->name }}
                {{ $price->shop->address->street }}
                {{ $price->shop->address->house }}
            </x-slot>
            <x-slot name="price">
                {{ $price->price }} {{ $price->currency->name }}
            </x-slot>
            <x-slot name="date">
                {{ $price->added_at }}
            </x-slot>
        </x-product.card>
        @endforeach
    </div>
</x-product-layout>

@props(['price' => null])

<div class="flex flex-col bg-white rounded-sm shadow-sm px-4 pt-4 pb-1 w-full my-2">
    <div class="flex flex-row my-1 py-1">
        <span class="font-semibold text-gray-800 min-w-max">Termék neve</span>
        <span class="flex-grow text-right">{{ $price->product->name }}</span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1">
        <span class="font-semibold text-gray-800 min-w-max">
            Bolt cime
        </span>
        <span class="flex-grow text-right">
            {{ $price->shop->name->name }} <br>
            {{ $price->shop->address->postalCode->city->name }} <br>
            {{ $price->shop->address->street }} <br>
            {{ $price->shop->address->house }}
        </span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1">
        <span class="font-semibold text-gray-800 min-w-max">
            Termék ára
        </span>
        <span class="flex-grow text-right">
            {{ $price->price }}
            {{ $price->currency->name }} / {{ $price->quantity }}
            {{ $price->per }}
        </span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1 pt-3 justify-between space-x-2">
        <a  href="{{ route('admin.edit', $price->id) }}"
            class=" text-left font-semibold text-indigo-800 min-w-max rounded-sm hover:bg-indigo-100 py-2 px-4">
            Szerkesztés
        </a>
        <form
            action="{{ route('admin.destroy', $price->id) }}"
            method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 font-semibold hover:bg-red-100 py-2 px-4 rounded-sm">Törlés</button>
        </form>
    </div>
</div>
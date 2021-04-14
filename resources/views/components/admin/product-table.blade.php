@props(['prices' => []])

<table class="w-full table">
    <thead class="text-center bg-indigo-700 text-white font-semibold">
        <tr>
            <td class="py-2 rounded-l-sm border-r border-gray-100" >Termék neve</td>
            <td class="py-2 border-r border-gray-100" >Bolt cime</td>
            <td class="py-2 border-r border-gray-100" >Termék ára</td>
            <td class="py-2 rounded-r-sm" colspan="2">Műveletek</td>
        </tr>
    </thead>
    <tbody class="bg-white rounded-sm shadow-sm">
        @foreach ($prices as $price)
            <tr>
                <td>{{ $price->product->name }}</td>
                <td>
                    {{ $price->shop->name->name }},
                    {{ $price->shop->address->postalCode->city->name }},
                    {{ $price->shop->address->street }}
                    {{ $price->shop->address->house }}
                </td>
                <td>
                    {{ $price->price }}
                    {{ $price->currency->name }} / {{ $price->quantity }}
                    {{ $price->per }}
                </td>
                <td class="flex flex-row justify-around items-center">
                    <a  href="{{ route('admin.edit', $price->id) }}"
                        class=" text-left font-semibold text-indigo-800 min-w-max rounded-sm hover:bg-indigo-100 px-4">
                        Szerkesztés
                    </a>
                    <form
                        action="{{ route('admin.destroy', $price->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 font-semibold hover:bg-red-100 px-4 rounded-sm">Törlés</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
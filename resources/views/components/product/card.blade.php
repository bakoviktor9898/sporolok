@props(['productId', 'shoppingList' => []])

<div class="relative w-full md:w-80 bg-white rounded-sm ring-1 shadow-sm ring-gray-100 p-4 flex-shrink-0 flex-grow-0 md:mx-2 my-2">
    <form
        method="POST"
        action="{{ route('shoppingList.update', ['id' => $productId]) }}"
        class="absolute top-6 right-6">
        @csrf
        @method('PUT')
        <button type="submit">
            <x-icons.heart-icon
                :productId="$productId"
                :shoppingList="$shoppingList">
            </x-icons.heart-icon>
        </button>
    </form>
    <a href="{{ route('product.show', $productId) }}">
    <figure>
        <figcaption
            class="flex flex-col">
            <span
                class="flex flex-row mb-1">
                <span
                    class="w-full font-semibold flex-grow overflow-ellipsis whitespace-nowrap overflow-hidden text-indigo-900">
                    {{ $name }}
                </span>
            </span>
            <span
                class="w-full flex-grow flex flex-row overflow-ellipsis whitespace-nowrap overflow-hidden text-gray-700">
                <span class="flex-grow">
                {{ $manufacturer }}
                </span>
                <span
                    class="w-2/6 text-right">
                    {{ $quantity }}
                </span>
            </span>
            <span
                class="mt-3 font-semibold text-gray-600">
                {{ $shop }}
            </span>
            <span
                class="text-sm mt-3 flex flex-row justify-between">
                <span
                    class="font-bold text-indigo-900">
                    {{ $price }}
                </span>
                <span>
                    {{ $date }}
                </span>
            </span>
        </figcaption>
    </figure>
    </a>
</div>

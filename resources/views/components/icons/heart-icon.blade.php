@props([
    'productId' => 0,
    'shoppingList' => []
])

<svg
    class="w-6 h-6 text-indigo-800 cursor-pointer"
    xmlns="http://www.w3.org/2000/svg"
    @if (in_array($productId, $shoppingList))
    fill="#3730a3"
    @else
    fill="none"
    @endif
    viewBox="0 0 24 24"
    stroke="currentColor">
    <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
</svg>
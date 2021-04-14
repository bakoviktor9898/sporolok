@props(['category' => null])

<div class="flex flex-col bg-white rounded-sm shadow-sm px-4 pt-4 pb-1 w-full my-2">
    <div class="flex flex-row my-1 py-1">
        <span class="font-semibold text-gray-800 min-w-max">Kategória neve</span>
        <span class="flex-grow text-right">{{ $category->name }}</span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1">
        <span class="font-semibold text-gray-800 min-w-max">
            Szülő kategória
        </span>
        <span class="flex-grow text-right">
            {{ $category->parent->name ?? 'Nincs' }}
        </span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1 pt-3 justify-between space-x-2">
        <a  href="{{ route('category.create') }}"
            class=" text-left font-semibold text-indigo-500 min-w-max rounded-sm hover:bg-indigo-100 py-2 px-4">
            Új Kategória
        </a>
        <a  href="{{ route('category.edit', $category->id) }}"
            class=" text-left font-semibold text-indigo-800 min-w-max rounded-sm hover:bg-indigo-100 py-2 px-4">
            Szerkesztés
        </a>
        
    </div>
</div>
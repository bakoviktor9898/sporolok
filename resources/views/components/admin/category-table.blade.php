@props(['categories' => []])

<table class="w-full table">
    <thead class="text-center bg-indigo-700 text-white font-semibold">
        <tr>
            <td class="py-2 rounded-l-sm border-r border-gray-100" >Kategória neve</td>
            <td class="py-2 border-r border-gray-100" >Szülő kategória</td>
            <td class="py-2 rounded-r-sm" colspan="2">Műveletek</td>
        </tr>
    </thead>
    <tbody class="bg-white rounded-sm shadow-sm">
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    {{ $category->parent->name ?? 'Nincs' }}
                </td>
                <td class="flex flex-row justify-around items-center">
                    <a  href="{{ route('category.create') }}"
                        class=" text-left font-semibold text-indigo-500 min-w-max rounded-sm hover:bg-indigo-100 px-4">
                        Új Kategória
                    </a>
                    <a  href="{{ route('category.edit', $category->id) }}"
                        class=" text-left font-semibold text-indigo-800 min-w-max rounded-sm hover:bg-indigo-100 px-4">
                        Szerkesztés
                    </a>
                    
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@props(['manufacturers' => []])

<table class="w-full table">
    <thead class="text-center bg-indigo-700 text-white font-semibold">
        <tr>
            <td class="py-2 rounded-l-sm border-r border-gray-100" >Gyarto neve</td>
            <td class="py-2 border-r border-gray-100" >Gyarto roviditett neve</td>
            <td class="py-2 rounded-r-sm" colspan="2">Műveletek</td>
        </tr>
    </thead>
    <tbody class="bg-white rounded-sm shadow-sm">
        @foreach ($manufacturers as $manufacturer)
            <tr>
                <td>{{ $manufacturer->name }}</td>
                <td>
                    {{ $manufacturer->short_name ?? 'Nincs' }}
                </td>
                <td class="flex flex-row justify-around items-center">
                    <a  href="{{ route('manufacturer.create') }}"
                        class=" text-left font-semibold text-indigo-500 min-w-max rounded-sm hover:bg-indigo-100 px-4">
                        Új Gyártó
                    </a>
                    <a  href="{{ route('manufacturer.edit', $manufacturer->id) }}"
                        class=" text-left font-semibold text-indigo-800 min-w-max rounded-sm hover:bg-indigo-100 px-4">
                        Szerkesztés
                    </a>
                    
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
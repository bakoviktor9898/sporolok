@props(['users' => []])

<table class="w-full table">
    <thead class="text-center bg-indigo-700 text-white font-semibold">
        <tr>
            <td class="py-2 rounded-l-sm border-r border-gray-100" >Felhasználói neve</td>
            <td class="py-2 border-r border-gray-100" >Email címe</td>
            <td class="py-2 border-r border-gray-100" >Jogosultsága </td>
            <td class="py-2 rounded-r-sm" colspan="2">Műveletek</td>
        </tr>
    </thead>
    <tbody class="bg-white rounded-sm shadow-sm">
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    @foreach ($user->roles as $role)
                        {{$role->name}}
                        
                    @endforeach
                </td>
                <td class="flex flex-row justify-around items-center">
                    
                    <a  href="{{ route('user.edit', $user->id) }}"
                        class=" text-left font-semibold text-indigo-800 min-w-max rounded-sm hover:bg-indigo-100 px-4">
                        Szerkesztés
                    </a>
                    <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                        type="submit"
                        class=" text-left font-semibold text-red-600 min-w-max rounded-sm hover:bg-indigo-100 px-4">
                        Törlés
                        </button>
                    </form>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@props(['user' => null])

<div class="flex flex-col bg-white rounded-sm shadow-sm px-4 pt-4 pb-1 w-full my-2">
    <div class="flex flex-row my-1 py-1">
        <span class="font-semibold text-gray-800 min-w-max">Felhasználói neve</span>
        <span class="flex-grow text-right">{{ $user->name }}</span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1">
        <span class="font-semibold text-gray-800 min-w-max">
            Email címe
        </span>
        <span class="flex-grow text-right">
            {{ $user->email }}
        </span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1">
        <span class="font-semibold text-gray-800 min-w-max">
            Jogosultsága
        </span>
        <span class="flex-grow text-right">
            @foreach ($user->roles as $role)
                {{$role->name}}
            @endforeach
        </span>
    </div>
    <div class="flex flex-row my-1 border-t border-gray-100 py-1 pt-3 justify-between space-x-2">
        
        <a  href="{{ route('user.edit', $user->id) }}"
            class=" text-left font-semibold text-indigo-800 min-w-max rounded-sm hover:bg-indigo-100 py-2 px-4">
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
        
    </div>
</div>
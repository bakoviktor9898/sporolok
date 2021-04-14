<x-user-layout>
    
    <div class="w-full bg-white rounded-sm px-6 py-6 md:pt-10 shadow-sm ring-1 ring-gray-50 max-w-md">

    <div class="flex flex-col items-center justify-center mb-4">
        <div>
            <svg 
            xmlns="http://www.w3.org/2000/svg"
            class="w-12 text-indigo-700"
            viewBox="0 0 20 20" 
            fill="currentColor">
                <path
                fill-rule="evenodd" 
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" 
                clip-rule="evenodd" />
            </svg>
        </div>
        <div 
            class="flex items-center">
                <h1 class=" text-indigo-700 text-xl mb-3 font-bold">
                  Személyes adatok
                </h1>
        </div>
    </div>

    <div class="flex flex-row text-center border border-gray-100 w-full mb-4 rounded-sm">
        <div class=" w-2/5 h-auto py-3 px-2 bg-indigo-700 text-white rounded-l-sm">
            Név
        </div>
        <div class="w-full py-3 px-2 text-center md:text-center">
            {{$user->name}}
        </div>       
    </div>

    <div class="flex flex-row text-center  border border-gray-100 w-full mb-4 rounded-sm">
        <div class=" w-2/5 h-auto py-3 px-2 bg-indigo-700 text-white rounded-l-sm">
            Email
        </div>
        <div class="w-full py-3 px-2 text-center md:text-center">
            {{$user->email}}
        </div>       
    </div>

    <div class="flex flex-row text-center border border-gray-100 w-full mb-4 rounded-sm">
        <div class="w-2/5 text-center  py-3 px-2 bg-indigo-700 text-white rounded-l-sm">
            Jogosultság
        </div>
        <div class="w-full  py-3 px-2 text-center">
        @foreach ($user->roles as $role)
            {{$role->name}}
        @endforeach
        </div>       
    </div>
    <hr class="mb-3">

    <div class="flex flex-row items-center w-full space-x-2">

        <form
            action="{{ route('profile.destroy', $user) }}"
            method="POST"
            class="flex flex-row items-center justify-center flex-grow">
            @csrf
            @method('DELETE')
            <button
                type="submit"
                class="w-full text-center font-semibold text-red-600 hover:bg-red-100 py-2 px-3 rounded-sm">
                Profil Törlése
            </button>
        </form>

        <div class="flex flex-row flex-grow">
            <a href="{{ route('profile.edit', $user) }}"
                class="text-indigo-700 w-full font-semibold hover:bg-indigo-100 text-center py-2 px-3 rounded-sm">
                Profil szerkesztése
            </a>
        </div>
            
    </div>
    
    </div>





    
</x-user-layout>
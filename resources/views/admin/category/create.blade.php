<x-admin-layout>
    <form 
        class="w-full bg-white rounded-sm px-4 py-6 md:pt-10 shadow-sm ring-1 ring-gray-50 max-w-lg md:m-auto mb-4 md:mb-0" 
        action="{{route('category.store')}}"
        method="POST">
        @csrf
        
    
       <h1 class="text-center font-bold text-indigo-700 text-lg">Új Kategória felvétele</h1>
        <x-forms.form-group>
            <div class="w-2/5">
                <x-label for="name">
                    Kategória neve
                </x-label>    
            </div>
            <div class="w-full">
                <x-input 
                    type="text" 
                    name="name" 
                    >
                </x-input>
            </div>
        </x-forms.form-group>
    
        
        <hr class="mt-4">
        <div class="flex flex-row items-center justify-center space-x-2 mt-4">
            <a
                href="{{ url()->previous() }}" 
                class="flex-grow text-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white tracking-wider rounded-sm font-semibold">
                Mégsem
            </a>
            <button
                type="submit"
                class="flex-grow text-center px-4 py-2 bg-indigo-700 hover:bg-indigo-800 text-white tracking-wider rounded-sm font-semibold">
                Mentés
            </button>
        </div>
    </form>
    
    </x-admin-layout>
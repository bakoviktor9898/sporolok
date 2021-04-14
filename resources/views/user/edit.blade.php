<x-user-layout>
        <form 
            class="w-full bg-white rounded-sm px-4 py-6 md:pt-10 shadow-sm ring-1 ring-gray-50 max-w-md" 
            action="{{route('profile.update',$user)}}"
            method="POST">
            @csrf
            @method('put')
            <h1 class="text-center text-indigo-800 font-semibold text-lg mb-4">
                Szerkezd meg a profilodat
            </h1>
        
            <x-forms.form-group>
                <div class="w-2/5">
                    <x-label for="name">
                        Nev
                    </x-label>    
                </div>
                <div class="w-full">
                    <x-input 
                        type="text" 
                        name="name"
                        requied
                        class="{{$errors->has('name')?'ring-1 ring-red-600 border-0':''}}" 
                        value="{{{$user->name}}}">
                    </x-input>
                    @error('name')
                        <span
                            class="font-medium tracking-normal w-full text-red-600 text-xs mt-1">
                                {{$message}}
                        </span>
                    @enderror
                </div>
            </x-forms.form-group>
        
            <x-forms.form-group>
                <div class="w-2/5">
                    <x-label for="email">
                        Email cim
                    </x-label>
                </div>
                <div class="w-full ">
                    <x-input 
                        type="email" 
                        name="email"
                        requied
                        class="{{$errors->has('email')?'ring-1 ring-red-600 border-0':''}}" 
                        value="{{{$user->email}}}">
                    </x-input>
                    @error('email')
                        <span
                            class="font-medium tracking-normal w-full text-red-600 text-xs mt-1">
                                {{$message}}
                        </span>
                    @enderror
                </div>
   
            </x-forms.form-group>
        
            <x-forms.form-group>
                <div class="w-2/5">
                    <x-label for="password">
                        Jelszo
                    </x-label>
                </div>
                <div class="w-full ">
                    <x-input 
                        type="password" 
                        name="password" 
                        requied
                        class="{{$errors->has('password')?'ring-1 ring-red-600 border-0':''}}"
                        >
                    </x-input>

                    
                </div>
                
            </x-forms.form-group>
            <x-forms.form-group>
                <div class="w-2/5">
                    <x-label for="password_confirmation">
                        Jelszo ujra
                    </x-label>
                </div>
                <div class="w-full">
                    <x-input 
                        type="password" 
                        name="password_confirmation" 
                        requied
                        class="{{$errors->has('password')?'ring-1 ring-red-600 border-0':''}}"
                        >
                    </x-input>
                    @error('password')
                        <span
                            class="font-medium tracking-normal w-full text-red-600 text-xs mt-1">
                                {{$message}}
                        </span>
                    @enderror
                </div>
                
            </x-forms.form-group>
        
            
            <hr class="mt-4">
            <div class="flex flex-row justify-center md:justify-between sm:justify-evenly">
                <div class="flex flex-col items-end sm:items-start space-x-2">
                    
                    <a 
                    class="text-center flex flex-row  justify-between items-center mt-4 px-4 py-2 bg-indigo-600 border border-transparent rounded-sm font-semibold text-sm text-white tracking-wider hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                    href="{{route('profile.show',$user)}}">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        class="text-white w-5"
                        viewBox="0 0 24 24" 
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                      </svg>
                        Vissza
                    </a>
                </div>
                <div 
                    class="flex flex-col items-start sm:items-start sm:px-1 content-end space-x-2 ">
                        <button 
                            type="submit"
                            class="text-center inline-flex justify-center items-center mt-4 px-4 py-2 bg-indigo-600 border border-transparent rounded-sm font-semibold text-sm text-white tracking-wider hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Modositas
                        </button>
                </div>
                
            </div>

        </form>
        

</x-user-layout>
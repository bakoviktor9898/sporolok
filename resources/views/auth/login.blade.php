<x-guest-layout>
    <div class="mb-4 flex flex-col items-center justify-center">
        <h3 class="text-center text-2xl text-indigo-700 font-semibold mb-2">Bejelentkezés</h3>
        <h4 class="text-center">Jelentkezz be spórolok profildoba!</h4>
    </div>
    <form
        method="POST"
        action="{{ route('login') }}"
        class="w-full bg-white rounded-sm px-4 py-6 md:pt-10 shadow-sm ring-1 ring-gray-50 max-w-md">
        @csrf

        <x-forms.form-group>
            <div class="w-2/5">
                <x-label>
                    Email cim
                </x-label>
            </div>
            <div class="flex flex-col w-full">
                <x-input
                    name="email"
                    type="email"
                    required
                    class="{{$errors->has('email')? 'ring-1 ring-red-600 border-0':''}} ">
                </x-input>
                @error('email')
                    <span
                        class="font-medium tracking-normal w-full text-red-600 text-xs mt-1">
                        The given email was incorrect
                    </span>
                @enderror
            </div>
        </x-forms.form-group>

            
        <x-forms.form-group>
            <div class="w-2/5">
                <x-label>
                    Jelszó
                </x-label>
            </div>
            <div class="flex flex-col w-full">
                <x-input
                    name="password"
                    type="password"
                    required
                    class="{{$errors->has('password')? 'ring-1 ring-red-600 border-0':''}} ">
                </x-input>
                @error('password')
                    <span
                        class="font-medium tracking-normal w-full text-red-600 text-xs mt-1">
                        The given password was incorrect
                    </span>
                @enderror
            </div>
        </x-forms.form-group>

        <div class="flex flex-row mb-2 items-center justify-end space-x-2">
            <x-button>Bejelentkezés</x-button>
        </div>

        <hr class="mt-6"/>

        <div class="mt-6 font-medium text-sm text-center">Nincs még profilod? <a class="text-indigo-700 font-semibold" href="{{ route('register') }}">Regisztálj most!</a></div>
    </form>
</x-guest-layout>

<x-shoppingList-layout>
    <div class="flex flex-col justify-center items-center">
        <h1 class="text-gray-700 text-xl text-center mb-6">
            Kedvencek
        </h1>
    </div>
    <div class="flex flex-col bg-white rounded-sm shadow-sm flex-grow mb-6 md:w-1/2 w-full">
        <div class="flex flex-col flex-grow">
       
            @foreach($prices as $item)
            <div class="my-2 flex flex-row space-x-2 items-center md:justify-center border-b border-gray-100 py-3 px-3">
                <x-icons.check-icon></x-icons.check-icon>
                <div class="flex flex-col w-full mr-2">
                    <div class="flex flex-row items-end w-full text-indigo-800 ">
                        <span class="flex-grow">{{ $item->product->name }}</span>
                        <span>{{ $item->price }} {{ $item->currency->name }}</span>
                    </div>
                    <span>
                        {{ $item->shop->name->name }},
                        {{ $item->shop->address->postalCode->city->name }}
                        {{ $item->shop->address->street }}
                        {{ $item->shop->address->house }}
                        
                    </span>
                </div>
                <form method="POST" action="{{ route('shoppingList.destroy', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 rounded-sm hover:bg-red-100">
                        <x-icons.trash-icon></x-icons.trash-icon>
                    </button>
                </form>


            </div>
            
            @endforeach
            
           
        </div>
        <div class="p-3 flex flex-row border-t border-gray-100">
             
             <span class="text-gray-700 flex-grow font-bold">Összesen {{$total}} FT</span>
             
            
          
        </div>
    </div>
    @if(Auth::check())
    <div class="flex flex-col justify-center md:w-1/2 w-full">
        <button class="text-white w-full md:w-auto py-2 bg-indigo-700 mb-6 ">Küldd el nekem emailben!</button>
    </div>
    @else
    <div class="flex flex-row justify-center border-t border-gray-100 py-4 md:w-auto">
        <a href="{{ route('login') }}" class="font-semibold text-indigo-700">Jelentkezz be</a>, hogy elküldjük neked emailben a bevásárlólistádat!
    </div>
    @endif

</x-shoppingList-layout>
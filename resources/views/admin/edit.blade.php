<x-admin-layout>
<form 
    class="w-full bg-white rounded-sm px-4 py-6 md:pt-10 shadow-sm ring-1 ring-gray-50 max-w-lg md:m-auto mb-4 md:mb-0" 
    action="{{route('admin.update',$product)}}"
    method="POST">
    @csrf
    @method('put')
    <div></div>
    <h1 class="text-center text-indigo-800 font-bold text-lg">
        {{{$product->shop->name->name}}},
        {{$product->shop->address->postalCode->code}},
        {{$product->shop->address->postalCode->city->name}}
        {{$product->shop->address->street}}
        {{$product->shop->address->house}}
    </h1>

    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="productName">
                Termék neve
            </x-label>    
        </div>
        <div class="w-full">
            <x-input 
                type="text" 
                name="productName" 
                value="{{{$product->product->name}}}">
            </x-input>
        </div>
    </x-forms.form-group>

    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="manufacturerName">
                Gyártó neve
            </x-label>
        </div>
        <div class="w-full">
            <x-input 
                type="text" 
                name="manufacturerName" 
                value="{{{$product->product->manufacturer->name}}}">
            </x-input>
        </div>
        
    </x-forms.form-group>

    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="manufacturerShortName">
                Gyártó rövid neve
            </x-label>
        </div>
        <div class="w-full">
            <x-input 
                type="text" 
                name="manufacturerShortName" 
                value="{{{$product->product->manufacturer->short_name}}}">
            </x-input>
        </div>
        
    </x-forms.form-group>

    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="categoryName">
                Kategória
            </x-label>
        </div>
        <div class="w-full">
            <x-input 
                type="text" 
                name="categoryName" 
                value="{{{$product->product->category->name}}}">
            </x-input>
        </div>
    </x-forms.form-group>
    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="price">
                Ár
            </x-label>
        </div>
        <div class="w-full">
            <x-input 
                type="number" 
                name="price" 
                value="{{{$product->price}}}">
            </x-input>
        </div>
    </x-forms.form-group>
    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="currency">
                Pénznem
            </x-label>
        </div>
        <div class="w-full">
            <x-input 
                type="text" 
                name="currency" 
                value="{{{$product->currency->name}}}">
            </x-input>
        </div>
    </x-forms.form-group>
    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="quantity">
                Mennyiség
            </x-label>
        </div>
        <div class="w-full">
            <x-input 
                type="number" 
                name="quantity" 
                value="{{{$product->quantity}}}">
            </x-input>
        </div>
    </x-forms.form-group>
    <x-forms.form-group>
        <div class="w-2/5">
            <x-label for="per">
                Mértékegység
            </x-label>
        </div>
        <div class="w-full">
            <x-input 
                type="text" 
                name="per" 
                value="{{{$product->per}}}">
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
    <x-input 
        type="hidden" 
        name="shop_id" 
        value="{{$product->shop->id}}">
    </x-input>
    <x-input 
        type="hidden" 
        name="price_id" 
        value="{{$product->id}}">
    </x-input>
    <x-input 
        type="hidden" 
        name="product_id" 
        value="{{$product->product->id}}">
    </x-input>
</form>

</x-admin-layout>
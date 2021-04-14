<x-admin-layout>
    <div class="md:hidden">
        @foreach($prices as $price)
        <x-admin.product-card
            :price="$price">
        </x-admin.product-card>
        @endforeach
    </div>
    <div class="hidden md:block">
        <x-admin.product-table
            :prices="$prices">
        </x-admin.product-table>
    </div>
</x-admin-layout>
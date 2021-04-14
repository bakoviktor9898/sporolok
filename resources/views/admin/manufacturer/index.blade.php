<x-admin-layout>
    <div class="md:hidden">
        @foreach($manufacturers as $manufacturer)
        <x-admin.manufacturer-card
            :manufacturer="$manufacturer">
        </x-admin.manufacturer-card>
        @endforeach
    </div>
    <div class="hidden md:block">
        <x-admin.manufacturer-table
            :manufacturers="$manufacturers">
        </x-admin.manufacturer-table>
    </div>
</x-admin-layout>
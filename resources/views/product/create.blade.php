<x-product-layout>
    <product-create
        lat="{{ session()->get('position')['lat'] }}"
        lng="{{ session()->get('position')['lng'] }}"
        api-key="{{ config('here.api_key') }}">
    </product-create>
</x-product-layout>

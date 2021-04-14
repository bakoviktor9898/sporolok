<x-admin-layout>
    <div class="md:hidden">
        @foreach($categories as $category)
        <x-admin.category-card
            :category="$category">
        </x-admin.category-card>
        @endforeach
    </div>
    <div class="hidden md:block">
        <x-admin.category-table
            :categories="$categories">
        </x-admin.category-table>
    </div>
</x-admin-layout>
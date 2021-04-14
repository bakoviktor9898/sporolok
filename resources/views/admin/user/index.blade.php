<x-admin-layout>
    <div class="md:hidden">
        @foreach($users as $user)
        <x-admin.user-card
            :user="$user">
        </x-admin.user-card>
        @endforeach
    </div>
    <div class="hidden md:block">
        <x-admin.user-table
            :users="$users">
        </x-admin.user-table>
    </div>
</x-admin-layout>
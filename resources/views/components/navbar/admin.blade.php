<div class="w-full flex flex-row justify-between items-center px-4 bg-indigo-100 relative">
    <h2 class="py-2 font-black text-left tracking-wider px-2 text-gray-600 text-lg flex-grow">Admin</h2>
    <div class="hidden md:flex flex-row md:flex-col items-center justify-center space-x-4">
        <a href="{{ route('admin.index') }}" class="font-semibold text-gray-700">Termékek</a>
        <a href="{{ route('category.index') }}" class="font-semibold text-gray-700">Kategóriák</a>
        <a href="{{route('manufacturer.index')}}" class="font-semibold text-gray-700">Gyártók</a>
        <a href="{{route('user.index')}}" class="font-semibold text-gray-700">Felhasználók</a>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" id="adminNavTrigger" class="h-6 w-6 md:hidden cursor-pointer hover:bg-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</div>
<div class="relative">
    <div id="adminNavItems" class="hidden flex-col px-4 items-start justify-center absolute top-0 left-0 right-0 w-full bg-indigo-100">
        <a href="{{ route('admin.index') }}" class="py-2 px-1">Termékek</a>
        <a href="{{ route('category.index') }}" class="py-2 px-1">Kategóriák</a>
        <a href="{{route('manufacturer.index')}}" class="py-2 px-1">Gyártók</a>
        <a href="{{route('user.index')}}" class="py-2 px-1">Felhasználók</a>
    </div>
</div>

@push('scripts')
<script>
    const toggle = document.getElementById('adminNavTrigger');
    const items = document.getElementById('adminNavItems');
    toggle.addEventListener('click', e => {
        if (items.classList.contains('hidden')) {
            items.classList.remove('hidden');
            items.classList.add('flex');
        } else {
            items.classList.remove('flex');
            items.classList.add('hidden');
        }
    })
</script>
@endpush
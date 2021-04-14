@props(['type' => 'submit'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'text-center inline-flex justify-center items-center mt-4 px-4 py-2 bg-indigo-600 border border-transparent rounded-sm font-semibold text-sm text-white tracking-wider hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

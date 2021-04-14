<template>
    <section class="ml-1 mb-3">
        <h3 class="text-gray-700 text-xl">
            <slot name="title"></slot>
        </h3>
        <div class="mt-2">
            <div class="overflow-scroll">
                <ul class="flex flex-row flex-nowrap space-x-3 mb-2 box-content w-full h-full list-none">
                    <slot name="items"></slot>
                </ul>
            </div>
        </div>
    </section>
</template>

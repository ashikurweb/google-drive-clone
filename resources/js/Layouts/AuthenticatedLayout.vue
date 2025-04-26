<script setup>
import Navigation from '@/app/Navigation.vue';
import SearchForm from '@/app/SearchForm.vue';
import UserSettingsDropdown from '@/app/UserSettingsDropdown.vue';

</script>

<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4">
        <Navigation />

    <main class="flex flex-col flex-1 px-4 overflow-auto">
        <div class="flex items-center justify-between w-full">
            <SearchForm />
            <UserSettingsDropdown />
        </div>

        <div class="flex-1 flex-col overflow-auto">
            <slot />
        </div>
    </main>
</div>

</template>

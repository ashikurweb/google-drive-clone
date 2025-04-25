
<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import CreateNewDropdown from "@/app/CreateNewDropdown.vue";
import NavLink from "@/Components/NavLink.vue";

</script>
<template>
    <nav class="min-w-[200px]">
        <div class="h-[80px] px-3 flex items-center gap-3">
            <Link href="/">
                <ApplicationLogo
                    class="block h-9 w-auto fill-current text-gray-500"
                />
            </Link>
            LaraStorage
        </div>

        <div class="px-3">
            <CreateNewDropdown />

            <div class="px-3 py-5">
                <NavLink href="" :active="true">My Files</NavLink>
                <NavLink href="">Shared with me</NavLink>
                <NavLink href="">Shared by me</NavLink>
                <NavLink href="">Trash</NavLink>
            </div>
        </div>
    </nav>
</template>
<template>
    <div class="h-screen">
        <nav class="flex justify-center w-full">
            <section class="w-11/12 lg:w-4/5 py-3">
                <LogoBar />
                <NavBar />
            </section>
        </nav>

        <div class="w-full flex justify-center">
            <div class="w-4/5">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
import LogoBar from "../Nav/LogoBar.vue";
import NavBar from "../Nav/NavBar.vue";

export default {
    name: "DefaultLayout",
    components: { NavBar, LogoBar },
};
</script>

<style scoped></style>

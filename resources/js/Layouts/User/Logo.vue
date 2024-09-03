<template>
    <Link
        :href="route('home')"
        class="d-flex align-center"
        color="surface"
    >
        <!--v-icon 
            class="mr-3"
            icon="mdi-plus"
            color="surface"
            size="48"
        /-->
        <div class="d-flex flex-column">
            <div class="d-flex">
                <div class="text-h4 main-text text-primary">MA</div>
                <div class="text-h4 main-text text-surface">Textile</div>
            </div>
            <p class="text-subtitle-2 text-surface">Îmbrăcăminte de lucru și accesorii</p>
        </div>
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

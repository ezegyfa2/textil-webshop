<template>
    <Link
        :href="route('home')"
        class="d-flex align-center"
        color="surface"
    >
        <v-img 
            class="mr-3 mt-1"
            src="storage/images/Logo.png"
            height="60"
            width="60"
        />
        <div class="d-flex flex-column">
            <div class="d-flex">
                <div class="text-h4 main-text text-primary">MA</div>
                <div class="text-h4 main-text text-surface">Textil</div>
            </div>
            <p class="text-subtitle-2 text-surface">Îmbrăcăminte și accesorii</p>
        </div>
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

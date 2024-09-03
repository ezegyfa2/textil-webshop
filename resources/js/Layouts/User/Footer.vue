<template>
    <v-footer class="bg-secondary">
        <v-row justify="center" no-gutters>
            <Link
                href="/"
                class="mx-2 text-surface"
            >
                Home
            </Link>
            <Link
                href="/products"
                class="mx-2 text-surface"
            >
                Products
            </Link>
        </v-row>
    </v-footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <Link
        class="blog-box"
        :href="blog.href"
    >
        <v-img
            class="blog-image mb-1"
            :src="blog.image_src"
            height="250"
            cover
        >
            <div class="image-content text-h5 font-weight-bold">Read more</div>
        </v-img>
        <p class="blog-date">{{ blog.created_at }}</p>
        <h3 class="text-h5 font-weight-bold mt-2 mb-4">{{ blog.title }}</h3>
        <p>{{ blog.content }}</p>
    </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { BlogShort } from '@/types/blog';

const props = defineProps<{
    blog: BlogShort,
}>();
</script>

<style scoped lang="scss">
@import '@styles/themeVariables.scss';

.image-content {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    color: $primary-color;
}
.blog-box:hover {
    color: $secondary-color;
}
.blog-box:hover .image-content {
    opacity: 1;
    background-color: rgba($secondary-color, 0.7);
    transition: $main-transition;
}
.blog-date {
    font-weight: bold;
    font-size: 12px;
}
</style>
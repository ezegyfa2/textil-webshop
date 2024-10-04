<template>
    <Link
        class="blog-box"
        :href="blog.href"
    >
        <div class="blog-short">
            <ImageBox 
                :src="blog.image_src"
                height="250"
            >
                <div class="image-content text-h5 font-weight-bold">Citiți mai mult</div>
            </ImageBox>
            <p class="blog-date mt-1">{{ blog.created_at }}</p>
            <h3 class="text-h5 font-weight-bold mt-4 mb-4">{{ blog.title }}</h3>
            <p class="mb-15">{{ blog.content }}</p>
        </div>
    </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import ImageBox from '@/Components/User/ImageBox.vue';
import { BlogShort } from '@/types/blog';

const props = defineProps<{
    blog: BlogShort,
}>();
</script>

<style scoped lang="scss">
.blog-date {
    font-weight: bold;
    font-size: 12px;
}
.blog-short {
    max-width: 500px;
}
</style>
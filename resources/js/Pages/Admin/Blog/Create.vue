<template>
    <MainLayout>
        <BlogForm
            @submitted="submit"
            title="Crearea blogului"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import BlogForm from '@/Components/Admin/Blog/Form.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: null,
    image: {},
});

function submit() {
    form.post(route('admin.blog.store'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
        },
    });
}
</script>

<template>
    <MainLayout>
        <BlogForm
            @submitted="submit"
            title="Editarea blogului"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import BlogForm from '@/Components/Admin/Blog/Form.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    blog: Object,
}>();

const form = useForm(props.blog);

function submit() {
    form.put(route('admin.blog.update', {
        blog: props.blog.id
    }), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
        },
    });
}
</script>

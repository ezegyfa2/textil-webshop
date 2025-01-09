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
import { handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';

const goTo = useGoTo();
const form = useForm({
    title: null,
    short_content: null,
    content: '',
    image: {},
});

function submit() {
    form.post(route('admin.blog.store'), {
        preserveScroll: true,
        onError: (errors) => {
            handleValidationErrors(errors, goTo);
        },
    });
}
</script>

<template>
    <MainLayout>
        <BrandForm
            @submitted="submit"
            title="Crearea brandului"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import BrandForm from '@/Components/Admin/Brand/Form.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    image: {},
});

function submit() {
    form.post(route('admin.brand.store'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
        },
    });
}
</script>

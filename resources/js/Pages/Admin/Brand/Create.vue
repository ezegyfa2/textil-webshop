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
import { handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';

const goTo = useGoTo();
const form = useForm({
    name: null,
    image: {},
});

function submit() {
    form.post(route('admin.brand.store'), {
        preserveScroll: true,
        onError: (errors) => {
            handleValidationErrors(errors, goTo);
        },
    });
}
</script>

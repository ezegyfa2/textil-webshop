<template>
    <MainLayout>
        <ProductCategoryForm
            @submitted="submit"
            title="Crearea produsului"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import ProductCategoryForm from '@/Components/Admin/ProductCategory/Form.vue';
import { handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';

const goTo = useGoTo();
const form = useForm({
    name: null,
    image: {},
});

function submit() {
    form.post(route('admin.product-category.store'), {
        preserveScroll: true,
        onError: (errors) => {
            handleValidationErrors(errors, goTo);
        },
    });
}
</script>

<template>
    <MainLayout>
        <ProductForm
            @submitted="submit"
            title="Crearea produsului"
            :form="form"
            :available_colors="available_colors"
        />
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import ProductForm from '@/Components/Admin/Product/Form.vue';
import { handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';

const props = defineProps({
    available_colors: Array,
});

const goTo = useGoTo();
const form = useForm({
    name: null,
    gram_per_m2: null,
    product_category: null,
    brand: null,
    fabric_properties: [],
    cut_properties: [],
    sizes: [],
    products: [],
    images: [],
});

function submit() {
    form.post(route('admin.product.store'), {
        preserveScroll: true,
        onError: (errors) => {
            handleValidationErrors(errors, goTo);
        },
    });
}
</script>

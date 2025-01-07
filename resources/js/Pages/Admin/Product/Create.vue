<template>
    <MainLayout>
        <ProductForm
            @submitted="submit"
            title="Crearea produsului"
            :form="form"
        />
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import ProductForm from '@/Components/Admin/Product/Form.vue';
import { useForm } from '@inertiajs/vue3';

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
            console.log(errors);
        },
    });
}
</script>

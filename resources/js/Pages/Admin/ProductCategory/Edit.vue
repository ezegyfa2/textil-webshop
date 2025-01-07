<template>
    <MainLayout>
        <ProductCategoryForm
            @submitted="submit"
            title="Editarea produsului"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import ProductCategoryForm from '@/Components/Admin/ProductCategory/Form.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    product_category: Object,
}>();

const form = useForm(props.product_category);

function submit() {
    form.put(route('admin.product-category.update', {
        productCategory: props.product_category.id
    }), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
        },
    });
}
</script>

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
import { handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';

const goTo = useGoTo();
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
            handleValidationErrors(errors, goTo);
        },
    });
}
</script>

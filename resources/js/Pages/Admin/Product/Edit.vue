<template>
    <MainLayout>
        <ProductForm
            @submitted="submit"
            title="Editarea produsului"
            :form="form"
            :available_colors="available_colors"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import ProductForm from '@/Components/Admin/Product/Form.vue';
import { handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';

const props = defineProps<{
    product: Object,
    available_colors: Array<Object>,
}>();

const goTo = useGoTo();
const form = useForm(props.product);

function submit() {
    form.put(route('admin.product.update', {
        productType: props.product.id
    }), {
        preserveScroll: true,
        onError: (errors) => {
            handleValidationErrors(errors, goTo);
        },
    });
}
</script>

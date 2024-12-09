<template>
    <MainLayout>
        <ProductForm
            @submitted="submit"
            title="Edit product"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import ProductForm from '@/Components/Admin/Product/Form.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    product: Object,
}>();

const form = useForm(props.product);

function submit() {
    form.put(route('admin.product.update', {
        productType: props.product.id
    }), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
        },
    });
}
</script>

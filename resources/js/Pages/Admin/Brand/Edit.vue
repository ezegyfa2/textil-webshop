<template>
    <MainLayout>
        <BrandForm
            @submitted="submit"
            title="Editarea brandului"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import BrandForm from '@/Components/Admin/Brand/Form.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    brand: Object,
}>();

const form = useForm(props.brand);

function submit() {
    form.put(route('admin.brand.update', {
        brand: props.brand.id
    }), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
        },
    });
}
</script>

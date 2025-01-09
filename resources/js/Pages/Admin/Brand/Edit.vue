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
import { handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';

const props = defineProps<{
    brand: Object,
}>();

const goTo = useGoTo();
const form = useForm(props.brand);

function submit() {
    form.put(route('admin.brand.update', {
        brand: props.brand.id
    }), {
        preserveScroll: true,
        onError: (errors) => {
            handleValidationErrors(errors, goTo);
        },
    });
}
</script>

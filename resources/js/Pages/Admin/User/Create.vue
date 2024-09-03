<template>
    <MainLayout>
        <UserForm
            title="Create new user"
            :form="form"
            @submit="submit"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import UserForm from '@/Components/Admin/User/Form.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
});

function submit() {
    form.post(route('admin:user.store'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
            form.reset('password');
        },
    });
}
</script>

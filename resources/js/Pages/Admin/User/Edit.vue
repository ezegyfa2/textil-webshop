<template>
    <MainLayout>
        <UserForm
            @submit="submit"
            title="Edit user"
            :form="form"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import UserForm from '@/Components/Admin/User/Form.vue';
import User from '@/types/user';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    user: User,
}>();

props.user.password = '';
const form = useForm(props.user);

function submit() {
    form.put(route('admin.user.update', props.user.id), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
            form.reset('password');
        },
    });
}
</script>

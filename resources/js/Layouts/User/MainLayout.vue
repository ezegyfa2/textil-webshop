<template>
    <v-app class="layout">
        <v-toolbar
            class="pt-7 pb-12"
            color="secondary"
        >
            <v-container>
                <v-row>
                    <v-col class="d-flex justify-start justify-sm-space-around justify-md-space-between align-center">
                        <Logo class="ml-2 ml-sm-0"/>
                        <div class="d-flex">
                            <IconText
                                class="d-none d-sm-flex ml-12"
                                icon="mdi-phone-in-talk-outline"
                                title="Apelați-ne 9:00am-6:00pm"
                                content="075 - 139 - 4963"
                            />
                            <IconText
                                class="d-none d-lg-flex ml-7"
                                icon="mdi-clock-outline"
                                title="De luni până vineri"
                                content="9:00am - 6:00pm"
                            />
                            <IconText
                                class="d-none d-md-flex ml-7"
                                icon="mdi-email-outline"
                                title="Trimiteți-ne un e-mail"
                                content="lekellcserelni@gmail.com"
                            />
                        </div>
                    </v-col>
                </v-row>
            </v-container>
        </v-toolbar>
        <Navbar/>
        <v-main class="main-content">
            <slot />
            <Notifications/>
        </v-main>
        <Footer/>
    </v-app>
</template>

<script setup lang="ts">
import Notifications from '@/Layouts/Notification/Notifications.vue';
import Logo from '@/Layouts/User/Logo.vue';
import Navbar from '@/Layouts/User/Navbar.vue';
import Footer from '@/Layouts/User/Footer.vue';
import IconText from '@/Layouts/User/IconText.vue';

const props = defineProps<{
    title?: string;
    subtitle?: string;
}>();
</script>

<style scoped>
.main-content {
    margin-top: -44px;
    padding-top: 0;
}
</style>

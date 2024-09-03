<template>
    <v-img :src="src">
        <a 
            :href="href"
            class="content"
        >
            <p class="text-h6">{{ content }}</p>
        </a>
    </v-img>
</template>

<script setup lang="ts">
const props = defineProps<{
    src: string,
    content: string,
    href: string,
}>();
</script>

<style scoped lang="scss">
@import '@styles/themeVariables';

.content {
    color: $surface-color;
    text-align: center;
    vertical-align: middle;
    width: calc(100% - 10px);
    height: calc(100% - 10px);
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: transparent;
    opacity: 0;
    transition: $main-transition;
}
.content:hover {
    background-color: rgba($secondary-color, 70%);
    opacity: 1;
    margin: 5px;
}
.text-h6 {
    color: $surface-color;
}
</style>

<template>
    <a class="button">
        <div class="skew-content">
            <div class="skew-content-text main-text">{{ content }}</div>
        </div>
    </a>
</template>

<script setup lang="ts">
const props = defineProps<{
    content: string;
}>()
</script>

<style scoped lang="scss">
@import '@styles/themeVariables';

.button {
    width: 180px;
    height: 100%;
    display: inline-block;
    background-color: $primary-color;
    transition: $main-transition;
}
.button:hover {
    background-color: $surface-variant-color;
    color: $primary-color;
    transition: $main-transition;
}
.skew-content {
    transform: skew(-15deg);
    width: 100%;
    height: 100%;
    margin-left: -10px;
    background-color: inherit;
}
.skew-content-text {
    width: 100%;
    height: 100%;
    font-weight: bold;
    font-size: 18px;
    transform: skew(15deg);
    margin-left: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: inherit;
}
</style>

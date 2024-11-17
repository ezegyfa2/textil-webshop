<template>
    <v-img 
        :src="src"
        :height="height"
        :width="width"
        :class="{ 'elevation-1': elevation }"
        cover
    >
        <div class="content">
            <slot/>
        </div>
    </v-img>
</template>

<script setup lang="ts">
const props = defineProps<{
    height?: number|string,
    width?: number|string,
    src: string,
    elevation: boolean,
}>();
</script>

<style scoped lang="scss">
@import '@styles/themeVariables';

.content {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    background-color: transparent;
    opacity: 0;
    transition: $main-transition;
}
.content:hover {
    background-color: rgba($secondary-color, 70%);
    opacity: 1;
}
</style>

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

<script setup>
const props = defineProps({
    height: Number|String|null,
    width: Number|String|null,
    src: String,
    elevation: {
        type: Boolean,
        default: true,
    },
});
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

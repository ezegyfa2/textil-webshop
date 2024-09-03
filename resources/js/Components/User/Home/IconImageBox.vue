<template>
    <v-img
        :src="src"
        height="230"
        :gradient="gradient"
        cover
    >
        <a
            class="content-box"
            :href="href"
        >
            <div class="content-section p-5">
                <div class="d-flex">
                    <v-icon 
                        class="mr-3"
                        :icon="icon"
                        color="primary"
                        size="48"
                    />
                    <div>
                        <p class="content-title pb-3">{{ title }}</p>
                        <p class="text-surface content">{{ content }}</p>
                    </div>
                </div>
            </div>
            <div class="title-section">
                <v-icon 
                    class="mr-3"
                    :icon="icon"
                    color="primary"
                    size="48"
                />
                <p class="title">{{ title }}</p>
            </div>
        </a>
    </v-img>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    title: string,
    content: string,
    icon: string,
    src: string,
    href: string,
    gradientColor?: string,
}>();

const gradient = computed(() => {
    if (props.gradientColor) {
        return `to right, ${props.gradientColor}ff, ${props.gradientColor}22`;
    } else {
        return '';
    }
})
</script>

<style lang="scss">
@import '@styles/themeVariables';

$content-box-height: 230px;
$title-section-height: 80px;

.content-box {
    width: 100%;
    height: $content-box-height;
    display: inline-block;
    border-top: 3px solid $primary-color;
    margin-top: -$title-section-height;
    transition: $main-transition;
}
.content-box:hover {
    transform: translateY($title-section-height);
    transition: $main-transition;
}
.content-section {
    background-color: rgba($secondary-color, 90%);
    height: $content-box-height;
    opacity: 0;
}
.content-box:hover .content-section {
    opacity: 1;
    background-color: rgba($secondary-color, 90%);
}
.content-title {
    color: $surface-color;
    font-weight: bold;
    font-size: 16px;
}
.content {
    font-size: 14px;
}
.title-section {
    background-color: rgba($secondary-color, 90%);
    height: $title-section-height;
    padding-left: 15px;
    padding-right: 15px;
    display: flex;
    align-items: center;
    transition: $main-transition;
}
.content-box:hover .title-section {
    opacity: 0;
}
.title {
    color: $surface-color;
    font-weight: bold;
    font-size: 16px;
}
</style>

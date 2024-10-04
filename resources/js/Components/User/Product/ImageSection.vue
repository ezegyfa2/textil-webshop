<template>
    <v-img
        width="100%"
        height="600"
        :src="selectedImageSource"
        cover
    />
    <v-sheet
        v-if="image_sources.length > 1"
        class="image-container-sheet"
    >
        <v-slide-group
            v-model="selectedImageNumber"
            class="w-100"
            selected-class="bg-success"
            mandatory
            show-arrows
        >
            <v-slide-group-item
                v-for="image_source in image_sources"
                v-slot="{ isSelected, toggle, selectedClass }"
            >
                <ImageBox
                    :class="['mx-4', 'image-box', selectedClass]"
                    height="150"
                    width="150"
                    :src="image_source"
                    @click="toggle"
                >
                    <v-icon
                        color="primary"
                        size="x-large"
                    >
                        mdi-eye
                    </v-icon>
                </ImageBox>
            </v-slide-group-item>
        </v-slide-group>
    </v-sheet>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import ImageBox from '@/Components/User/ImageBox.vue';

const props = defineProps<{
    image_sources: string[],
}>();
let selectedImageNumber = ref(0);
const selectedImageSource = computed(() => {
    if (props.image_sources.length == 0) {
        return '';
    } else {
        return props.image_sources[selectedImageNumber.value];
    }
});
</script>

<style lang="scss">
@import "@styles/themeVariables";

.image-container-sheet {
    margin-top: 50px;
}

.image-container-sheet .v-slide-group__prev {
    padding-left: 3px;
    padding-right: 30px;
}
.image-container-sheet .v-slide-group__next {
    padding-left: 30px;
    padding-right: 3px;
}
.image-container-sheet .v-slide-group__prev,
.image-container-sheet .v-slide-group__next {
    min-width: 0;
    flex: none !important;
}

.image-container-sheet .v-slide-group__prev i,
.image-container-sheet .v-slide-group__next i {
    width: 50px;
    height: 50px;
    background-color: $primary-color;
    border-radius: 50%;
}
.image-container-sheet .v-slide-group__prev:not(.v-slide-group__prev--disabled):hover i,
.image-container-sheet .v-slide-group__next:not(.v-slide-group__next--disabled):hover i {
    background-color: $secondary-color;
    color: $primary-color;
    transition: $main-transition;
}

.image-box.bg-success {
    border: 2px solid $primary-color;
}
</style>
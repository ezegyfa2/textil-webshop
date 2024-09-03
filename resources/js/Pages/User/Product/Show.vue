<template>
    <MainLayout>
        <v-container class="top-section-separator">
            <v-row>
                <v-col cols="12" md="6">
                    <v-img
                        width="100%"
                        height="600"
                        :src="image_sources[0]"
                        cover
                    />
                    <v-sheet
                        class="mx-auto"
                        elevation="8"
                        max-width="800"
                    >
                        <v-slide-group
                            v-model="model"
                            class="pa-4"
                            selected-class="bg-success"
                            show-arrows
                        >
                            <v-slide-group-item
                                v-for="n in 15"
                                :key="n"
                                v-slot="{ isSelected, toggle, selectedClass }"
                            >
                                <v-card
                                    :class="['ma-4', selectedClass]"
                                    color="grey-lighten-1"
                                    height="200"
                                    width="100"
                                    @click="toggle"
                                >
                                    <div class="d-flex fill-height align-center justify-center">
                                        <v-scale-transition>
                                            <v-icon
                                                v-if="isSelected"
                                                color="white"
                                                icon="mdi-close-circle-outline"
                                                size="48"
                                            ></v-icon>
                                        </v-scale-transition>
                                    </div>
                                </v-card>
                            </v-slide-group-item>
                        </v-slide-group>
                    </v-sheet>
                </v-col>
                <v-col class="pl-md-15" cols="12" md="6">
                    <h1 class="text-h3">{{ name }}</h1>
                    <p class="text-h6">{{ price }}</p>
                    <v-btn size="large">ADD TO CART</v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    {{ description }}
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from "@/Layouts/User/MainLayout.vue";

const props = defineProps<{
    name: string,
    description: string,
    price: number,
    image_sources: string[],
}>();
</script>

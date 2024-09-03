<template>
    <div class="client-opinion-container py-16">
        <v-container>
            <v-row>
                <v-col>
                    <h1 class="text-h3 text-surface text-center mb-14">Opinia clienților noștri despre noi</h1>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <v-sheet>
                        <v-slide-group
                            v-model="model"
                            selected-class="bg-primary"
                            :show-arrows="false"
                        >
                            <v-slide-group-item
                                v-for="clientOpinion in clientOpinions"
                                :key="clientOpinion.client.companyName" 
                                v-slot="{ isSelected, toggle, selectedClass }"
                            >
                                <v-col class="opinion-box d-flex flex-column justify-between" cols="12" sm="6" md="4">
                                    <p class="text-body-1">{{ clientOpinion.content }}</p>
                                    <div class="d-flex align-center justify-start">
                                        <div>
                                            <v-img
                                                :src="clientOpinion.logoSrc"
                                                class="mr-5"
                                                width="70"
                                                height="70"
                                                cover
                                            />
                                        </div>
                                        <div>
                                            <p class="text-h6 text-primary">{{ clientOpinion.client.name }}</p>
                                            <p>{{ clientOpinion.client.companyName }}</p>
                                        </div>
                                    </div>
                                </v-col>
                            </v-slide-group-item>
                        </v-slide-group>

                        <v-expand-transition>
                            <v-sheet
                                v-if="model != null"
                                height="200"
                            >
                                <div class="d-flex fill-height align-center justify-center">
                                    <h3 class="text-h6">
                                        Selected {{ model }}
                                    </h3>
                                </div>
                            </v-sheet>
                        </v-expand-transition>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
let model = null;
let clientOpinions = [
    {
        client: {
            name: 'Jozsef Marci',
            companyName: 'Shoes corporation',
        },
        content: 'Quality shoes in good price, we buyed 10 shoes, 20 shirts and many other things that we used long time.',
        logoSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
    },
    {
        client: {
            name: 'Jozsef Marci',
            companyName: 'Shoes corporation',
        },
        content: 'Quality shoes in good price, we buyed 10 shoes, 20 shirts and many other things that we used long time.',
        logoSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
    },
    {
        client: {
            name: 'Jozsef Marci',
            companyName: 'Shoes corporation',
        },
        content: 'Quality shoes in good price, we buyed 10 shoes, 20 shirts and many other things that we used long time.',
        logoSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
    },
    {
        client: {
            name: 'Jozsef Marci',
            companyName: 'Shoes corporation',
        },
        content: 'Quality shoes in good price, we buyed 10 shoes, 20 shirts and many other things that we used long time.',
        logoSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
    },
]
</script>

<style lang="scss">
@import '@styles/themeVariables.scss';

.client-opinion-container {
    background-color: $secondary-color;
}
.client-opinion-container .v-slide-group__prev, .client-opinion-container .v-slide-group__next {
    display: none !important;
}
.opinion-box {
    height: 300px;
    width: 300px;
    padding: 30px;
    color: $surface-color;
    background-color: $secondary-color;
    border-right: 2px solid $surface-color;
}
</style>

<template>
    <div class="client-opinion-container py-16">
        <v-container>
            <v-row>
                <v-col>
                    <h1 class="text-h3 text-surface text-center mb-14">Opinia clienților noștri despre noi</h1>
                </v-col>
            </v-row>
            <v-row class="justify-center">
                <v-col
                    class="opinion-box d-flex flex-column justify-md-space-between left-column"
                    cols="12" sm="6" md="4"
                >
                    <p class="text-center text-sm-start text-body-1 mb-8 mb-sm-10">{{ clientOpinions[0].content }}</p>
                    <div class="d-flex flex-grow-1 align-end justify-center justify-sm-start">
                        <div>
                            <v-img
                                :src="clientOpinions[0].logoSrc"
                                class="mr-5"
                                width="70"
                                height="70"
                                cover
                            />
                        </div>
                        <div>
                            <p class="text-h6 text-primary">{{ clientOpinions[0].client.name }}</p>
                            <p>{{ clientOpinions[0].client.companyName }}</p>
                        </div>
                    </div>
                </v-col>
                <v-col
                    class="opinion-box d-flex flex-column justify-md-space-between center-column"
                    cols="12" sm="6" md="4"
                >
                    <p class="text-center text-sm-start text-body-1 mb-8 mb-sm-10">{{ clientOpinions[1].content }}</p>
                    <div class="d-flex flex-grow-1 align-end justify-center justify-sm-start">
                        <div>
                            <v-img
                                :src="clientOpinions[1].logoSrc"
                                class="mr-5"
                                width="70"
                                height="70"
                                cover
                            />
                        </div>
                        <div>
                            <p class="text-h6 text-primary">{{ clientOpinions[1].client.name }}</p>
                            <p>{{ clientOpinions[1].client.companyName }}</p>
                        </div>
                    </div>
                </v-col>
                <v-col
                    class="opinion-box d-flex flex-column justify-md-space-between"
                    cols="12" sm="6" md="4"
                >
                    <p class="text-center text-md-start text-body-1 mb-8 mb-sm-10">{{ clientOpinions[2].content }}</p>
                    <div class="d-flex flex-grow-1 align-end justify-center justify-lg-start">
                        <div>
                            <v-img
                                :src="clientOpinions[2].logoSrc"
                                class="mr-5"
                                width="70"
                                height="70"
                                cover
                            />
                        </div>
                        <div>
                            <p class="text-h6 text-primary">{{ clientOpinions[2].client.name }}</p>
                            <p>{{ clientOpinions[2].client.companyName }}</p>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
let clientOpinions = [
    {
        client: {
            name: 'Jozsef Marci',
            companyName: 'Shoes corporation',
        },
        content: 'Am avut o experiență excelentă cu acest magazin online! Am comandat mai multe tricouri polo de diferite culori.',
        logoSrc: '/storage/images/Company-logo1/400.webp',
    },
    {
        client: {
            name: 'Lukács Márton',
            companyName: 'Megatool srl.',
        },
        content: 'Recomand cu căldură acest magazin pentru toți cei care caută tricouri polo de calitate superioară! Se vede clar că sunt atenți la detalii și oferă o gamă variată de modele, culori și mărimi.',
        logoSrc: '/storage/images/Company-logo2/400.webp',
    },
    {
        client: {
            name: 'Kalapos Bálint',
            companyName: 'Yellow shop',
        },
        lastItem: true,
        content: 'Un magazin online de încredere! Tricourile polo pe care le-am comandat sunt exact așa cum mă așteptam, chiar mai bune decât în poze.',
        logoSrc: '/storage/images/Company-logo3/400.webp',
    },
]
</script>

<style lang="scss">
@import 'vuetify/lib/styles/settings/_variables';
@import '@styles/themeVariables.scss';

.client-opinion-container {
    background-color: $secondary-color;
}
.opinion-box {
    padding: 30px;
    color: $surface-color;
    background-color: $secondary-color;
}
@media #{map-get($display-breakpoints, 'sm-and-up')} {
    .left-column {
        border-right: 2px solid $surface-color;
    }
}
@media #{map-get($display-breakpoints, 'md-and-up')} {
    .center-column {
        border-right: 2px solid $surface-color;
    }
}
</style>

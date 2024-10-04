<template>
    <MainLayout>   
        <DescriptionSection 
            class="large-section-separator"
            title="Mulțumim pentru comandă"
            content="Vă mulțumim pentru cumpărături cu noi, echipa noastră de vânzări vă va contacta în scurt timp pentru a aranja detaliile de livrare"
            button-text="Înapoi la pagina principală"
            src="storage/images/Importance of fashion/1200.webp"
            :href="route('home')"
        />
        <!--v-container>
            <v-row class="justify-center">
                <v-col cols="12" sm="6" md="9">
                    <v-card
                        class="section-separator"
                        rounded="0"
                    >
                        <v-card-title class="text-h5 text-center main-text mt-6">
                            Mulțumim pentru comandă
                        </v-card-title>

                        <v-card-text class="text-center px-10">
                            <p class="text-body-1 mb-14">Vă mulțumim pentru cumpărături cu noi, echipa noastră de vânzări vă va contacta în scurt timp pentru a aranja detaliile de livrare</p>
                            <v-btn
                                class="mb-6"
                                size="x-large"
                                type="submit"
                            >
                                <p class="text-body-1 main-text">Înapoi la pagina principală</p>
                            </v-btn>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container-->
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import DescriptionSection from '@/Components/User/DescriptionSection.vue';
</script>

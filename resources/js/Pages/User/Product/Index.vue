<template>
    <MainLayout>
        <v-container>
            <v-row>
                <v-col>
                    <v-card>
                        <v-data-iterator
                            :items="products"
                            :items-per-page="productsPerPage"
                        >
                            <template v-slot:header>
                                <v-toolbar class="px-2">
                                    <v-text-field
                                        v-model="search"
                                        density="comfortable"
                                        placeholder="Search"
                                        prepend-inner-icon="mdi-magnify"
                                        style="max-width: 300px;"
                                        variant="solo"
                                        clearable
                                        hide-details
                                    ></v-text-field>
                                </v-toolbar>
                            </template>

                            <template v-slot:default="{ items }">
                                <v-container class="pa-2" fluid>
                                    <v-row dense>
                                        <v-col
                                            v-for="item in items"
                                            :key="item.name"
                                            class="pa-2"
                                            cols="12"
                                            sm="6"
                                            md="3"
                                        >
                                            <Link :href="route('product.show', {product: item.raw.id})">
                                                <v-card
                                                    class="product-box"
                                                    color="white"
                                                    rounded="0"
                                                    flat
                                                >
                                                    <v-img 
                                                        width="100%"
                                                        height="300"
                                                        :src="item.raw.image_src"
                                                        cover
                                                    >
                                                        <div class="image-hover-content">
                                                            <v-icon 
                                                                icon="mdi-eye"
                                                                color="primary"
                                                                size="80"
                                                            />
                                                        </div>
                                                    </v-img>

                                                    <div class="p-5">

                                                        <div class="d-flex justify-space-between align-center">
                                                            <div>
                                                                <strong class="product-box-text text-h6 font-weight-bold">{{ item.raw.name }}</strong>
                                                                <div class="product-box-text text-subtitle-2">{{ item.raw.price }} RON</div>
                                                            </div>

                                                            <v-btn
                                                                size="small"
                                                                text="Read"
                                                                icon="mdi-cart"
                                                                flat
                                                            ></v-btn>
                                                        </div>
                                                    </div>
                                                </v-card>
                                            </Link>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </template>

                            <template v-slot:footer>
                                <div class="d-flex align-center justify-center pa-4">
                                    <v-btn
                                        :disabled="page <= 1"
                                        density="comfortable"
                                        icon="mdi-arrow-left"
                                        variant="tonal"
                                        rounded
                                        @click="prevPage"
                                    ></v-btn>

                                    <div class="mx-2 text-caption">
                                        Page {{ page }} of {{ pageCount }}
                                    </div>

                                    <v-btn
                                        :disabled="page >= pageCount"
                                        density="comfortable"
                                        icon="mdi-arrow-right"
                                        variant="tonal"
                                        rounded
                                        @click="nextPage"
                                    ></v-btn>
                                </div>
                            </template>
                        </v-data-iterator>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/User/MainLayout.vue';
import { ref, computed, watch, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

let search = ref('');
let products = ref([]);
let page = ref(1);
let pageCount = ref(1);
let productsPerPage = ref(10);
let loading = ref(false);
let errorMessages = ref([]);

function nextPage() {
    if (page.value < pageCount.value) {
        ++page.value;
        fetch();
    } else {
        throw new Error('Maximum page number exceeded');
    }
}

function prevPage() {
    if (page.value > 0) {
        --page.value;
        fetch();
    } else {
        throw new Error('Minimum page number exceeded');
    }
}

watch(search, () => {
    fetch();
});

onMounted(fetch);

function fetch() {
    loading.value = true;
    axios.get(route('product.fetch', fetchFilterValues.value))
    .then((response) => {
        products.value = response.data.data;
        pageCount.value = Math.ceil(response.data.meta.total / response.data.meta.per_page);
        if (page.value > pageCount.value) {
            page.value = pageCount.value;
        }
        errorMessages.value = [];
    })
    .catch((error) => {
        console.error(error);
        errorMessages.value = error.response.data.errors;
        products.value = [];
    })
    .finally(() => {
        loading.value = false;
    });
}

const fetchFilterValues = computed(() => {
    return {
        page: page.value,
        per_page: productsPerPage.value,
        search: search.value,
    };
});
</script>

<style scoped lang="scss">
@import "@styles/themeVariables";

.image-hover-content {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    background-color: black;
}
.image-hover-content:hover {
    opacity: 0.7;
}
.product-box:hover .product-box-text {
    color: yellow;
}
</style>

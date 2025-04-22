<template>
    <v-data-iterator
        :items="products"
        :items-per-page="productsPerPage"
    >
        <template v-slot:default="{ items }">
            <v-container
                v-if="loading"
                class="pa-2"
                fluid
            >
                <v-row dense>
                    <v-col
                        v-for="item in 8"
                        class="pa-2"
                        cols="12" sm="6" md="3"
                    >
                        <v-skeleton-loader type="card"/>
                    </v-col>
                </v-row>
            </v-container>
            <v-container
                v-else
                class="pa-2"
                fluid
            >
                <v-row dense>
                    <v-col
                        v-for="item in items"
                        :key="item.name"
                        class="pa-2"
                        cols="12" sm="6" md="3"
                    >
                        <v-card
                            class="product-box d-flex flex-column h-100"
                            color="white"
                            rounded="0"
                        >
                            <Link :href="route('product.show', {productType: item.raw.id})">
                                <ImageBox
                                    width="100%"
                                    height="300"
                                    :src="item.raw.image_src"
                                >
                                    <v-icon 
                                        icon="mdi-eye"
                                        color="primary"
                                        size="80"
                                    />
                                </ImageBox>
                            </Link>

                            <div class="p-5 flex-grow-1 d-flex flex-column justify-space-between">
                                <p class="text-body-1 main-text mb-5">{{ item.raw.name }}</p>
                                <div class="d-flex justify-space-between align-center">
                                    <div>
                                        <div v-if="Array.isArray(item.raw.price)" class="text-body-2 main-text">
                                            {{ item.raw.price[0] }} RON - {{ item.raw.price[1] }} RON
                                        </div>
                                        <div v-else class="text-body-2 main-text">{{ item.raw.price }} RON</div>
                                    </div>

                                    <v-btn
                                        size="small"
                                        icon="mdi-cart"
                                        flat
                                        :disabled="loading"
                                        :loading="loading"
                                        @click="router.visit(route('product.show', {productType: item.raw.id}))"
                                    />
                                </div>
                            </div>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </template>

        <template v-slot:footer>
            <div
                v-if="pageCount > 0"
                class="d-flex align-center justify-center pa-4"
            >
                <v-btn
                    :disabled="selectedPage <= 1"
                    density="comfortable"
                    icon="mdi-arrow-left"
                    variant="tonal"
                    rounded="0"
                    @click="prevPage"
                />

                <div class="mx-2 text-caption">
                    Pagina {{ selectedPage }} din {{ pageCount }}
                </div>

                <v-btn
                    :disabled="selectedPage >= pageCount"
                    density="comfortable"
                    icon="mdi-arrow-right"
                    variant="tonal"
                    rounded="0"
                    @click="nextPage"
                />
            </div>
        </template>

        <template v-slot:no-data>
            <div class="w-100 d-flex justify-center">
                <p
                    v-if="!loading && itemsLoaded"
                    class="text-body-1 py-16"
                >
                    Nu există niciun produs care să corespundă criteriilor de căutare
                </p>
            </div>
        </template>
    </v-data-iterator>
</template>

<script setup>
import ImageBox from '@/Components/User/ImageBox.vue';
import { addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';
import { usePage, Link, router } from '@inertiajs/vue3';
import { ref, computed, watch, onMounted } from 'vue';
import { useGoTo } from 'vuetify';

const props = defineProps({
    filters: Object,
});

const goTo = useGoTo();
const page = usePage();
const products = ref([]);
const selectedPage = ref(1);
const pageCount = ref(1);
const productsPerPage = ref(12);
const itemsLoaded = ref(false);
const loading = defineModel('loading');
const errorMessages = defineModel('errorMessages');

function nextPage() {
    if (selectedPage.value < pageCount.value) {
        ++selectedPage.value;
        fetch();
    } else {
        throw new Error('Maximum page number exceeded');
    }
}

function prevPage() {
    if (selectedPage.value > 0) {
        --selectedPage.value;
        fetch();
    } else {
        throw new Error('Minimum page number exceeded');
    }
}

watch(() => selectedPage.value, () => {
    goTo(0);
});

watch(() => props.filters, () => {
    fetch();
}, {
    deep: true,
});

const fetch = debounce(async () => {
    loading.value = true;
    axios.get(route('product.fetch', fetchFilterValues.value))
        .then((response) => {
            products.value = response.data.data;
            pageCount.value = Math.ceil(response.data.meta.total / response.data.meta.per_page);
            if (selectedPage.value > pageCount.value) {
                selectedPage.value = pageCount.value;
            }
            errorMessages.value = [];
        })
        .catch((error) => {
            console.error(error);
            if (error.response.data.errors) {
                errorMessages.value = error.response.data.errors;
            }
            addUnexpectedErrorNotification();
            products.value = [];
        })
        .finally(() => {
            loading.value = false;
            if (!itemsLoaded.value) {
                itemsLoaded.value = true;
            }
        });
}, 400);

const fetchFilterValues = computed(() => {
    return Object.assign({
        page: selectedPage.value,
        per_page: productsPerPage.value,
    }, props.filters);
});

onMounted(() => {
    fetch();
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
</style>


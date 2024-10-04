<template>
    <v-data-iterator
        :items="blogs"
        :items-per-page="blogsPerPage"
    >
        <template v-slot:default="{ items }">
            <v-container class="pa-2" fluid>
                <v-row dense>
                    <v-col
                        v-for="item in items"
                        :key="item.raw.title"
                        class="pa-2"
                        cols="12" sm="6" md="4"
                    >
                        <BlogShortSection :blog="item.raw"/>
                    </v-col>
                </v-row>
            </v-container>
        </template>

        <template v-slot:footer>
            <div class="d-flex align-center justify-center pa-4">
                <v-btn
                    :disabled="selectedPage <= 1"
                    density="comfortable"
                    icon="mdi-arrow-left"
                    variant="tonal"
                    rounded="0"
                    @click="prevPage"
                />

                <div class="mx-2 text-caption">
                    Page {{ selectedPage }} of {{ pageCount }}
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
    </v-data-iterator>
</template>

<script setup lang="ts">
import BlogShortSection from '@/Components/User/BlogShortSection.vue';
import { addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';
import { usePage } from '@inertiajs/vue3';
import { ref, computed, watch, onMounted } from 'vue';

const props = defineProps<{
    search: string,
}>();

const page = usePage();
const blogs = ref([]);
const selectedPage = ref(1);
const pageCount = ref(1);
const blogsPerPage = ref(10);
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

const fetch = debounce(() => {
    loading.value = true;
    axios.get(route('blog.fetch', fetchFilterValues.value))
        .then((response) => {
            blogs.value = response.data.data;
            pageCount.value = Math.ceil(response.data.meta.total / response.data.meta.per_page);
            if (page.value > pageCount.value) {
                page.value = pageCount.value;
            }
            errorMessages.value = [];
        })
        .catch((error) => {
            console.error(error);
            if (error.response.data.errors) {
                errorMessages.value = error.response.data.errors;
            }
            addUnexpectedErrorNotification();
            blogs.value = [];
        })
        .finally(() => {
            loading.value = false;
        });
}, 300);

const fetchFilterValues = computed(() => {
    return {
        page: selectedPage.value,
        per_page: blogsPerPage.value,
        search: props.search,
    };
});

watch(() => props.search, fetch);

onMounted(fetch);
</script>

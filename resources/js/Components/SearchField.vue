<template>
    <v-autocomplete
        v-model="selected"
        v-model:search="search"
        :items="items"
        :loading="loading"
        :disabled="disabled"
        :label="label"
        :name="name"
        placeholder="Începeți să tastați pentru caută"
        :error-messages="error_messages"
        :required="required"
        :dense="dense"
        outlined
        hide-no-data
        no-filter
        :item-title="item_title"
        :item-value="item_value"
        prepend-inner-icon="mdi-magnify"
        return-object
        clearable
        :hide-details="hide_details"
        :chips="isMultiple"
        :closable-chips="isMultiple"
        :multiple="isMultiple"
    />
</template>

<script setup>
import { ref, watch, computed } from 'vue';

const selected = defineModel();
const loading = defineModel('loading');
const disabled = defineModel('disabled');

const props = defineProps({
    search_route: {
        type: String,
        required: true,
    },
    label: String,
    item_title: {
        type: String,
        default: "name",
    },
    item_value: {
        type: String,
        default: "id",
    },
    item_sub_text: {
        type: String,
        default: null,
    },
    required: Boolean,
    name: String,
    hide_details: {
        default: false,
    },
    error_messages: {},
    dense: {
        type: Boolean,
        default: true,
    },
});

const isMultiple = computed(() => Array.isArray(selected.value));

let defaultItems = [];
if (isMultiple.value) {
    defaultItems = selected.value;
} else if (selected.value !== null) {
    defaultItems = [selected.value];
}
const items = ref(defaultItems);
const search = ref("");
const firstSearch = true;

watch(() => search.value, () => {
    // Avoiding search while page loading
    if (firstSearch.value) {
        firstSearch.value = false;
    } else {
        fetch();
    }
});

const fetch = debounce(() => {
    //disabled.value = true;
    axios.get(route(props.search_route, {
        search: search.value,
    }))
    .then(response => {
        items.value = response.data
    })
    .catch(error => {
        console.error(error)
    })
}, 400);
</script>

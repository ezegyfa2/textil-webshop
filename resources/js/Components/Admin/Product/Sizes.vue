<template>
    <v-table>
        <v-card rounded="0">
            <v-data-table
                class="size-table"
                :headers="headers"
                :items="rows"
                hide-default-footer
                disable-sort
            >
                <template
                    v-for="i in sizeNames.length"
                    #[`header.${sizeNames[i]}`]="{value}"
                >
                    <input
                        v-if="sizeNames[i] != 'type'"
                        v-model="sizeNames[i]"
                        class="size-input"
                    />
                </template>
                <template
                    v-for="header in headers"
                    #[`item.${header.key}`]="{value, index}"
                >
                    <input
                        v-model="rows[index][header.key]"
                        class="size-input"
                    />
                </template>
            </v-data-table>
        </v-card>
    </v-table>
</template>

<script setup>
import { ref, computed } from 'vue';

const sizes = defineModel();

const rows = ref([]);
for (let sizeType of Object.keys(sizes.value)) {
    let row = {
        type: sizeType,
    };
    for (let sizeName of Object.keys(sizes.value[sizeType])) {
        row[sizeName] = sizes.value[sizeType][sizeName];
    }
    rows.value.push(row);
}

const sizeNames = ref([]);
if (rows.value.length > 0) {
    sizeNames.value = Object.keys(rows.value[0]);
}

const headers = computed(() => {
    return sizeNames.value.map(row => {
        return {
            key: row,
            title: row,
            sortable: false,
        };
    });
});

const computedSizes = computed(() => {
    let computedSizeValues = {};
    for (let i = 0; i < rows.value.length; ++i) {
        computedSizeValues[rows.value[i].type] = Object.assign({}, rows.value[i]);
        delete computedSizeValues[rows.value[i].type].type;
    }
    return computedSizeValues;
});
</script>

<style>
.size-table td, .size-table th {
    padding-left: 5px !important;
    padding-right: 5px !important;
}
.size-input {
    width: 100%;
    padding: 4px;
    border-bottom: 1px solid black;
    background-color: #F6F6F6;
    -webkit-background-clip: inherit;
}
</style>
<template>
    <v-card>
        <v-card-title>
            <h2 class="text-h5">Dimensiuni</h2>
        </v-card-title>
        <v-card-text>
            <p class="mb-6">Dacă doriți să adăugați sau să ștergeți o coloană, deplasați mouse-ul la unul dintre câmpurile de sus și faceți clic pe butonul corespunzător. Dacă doriți să adăugați sau să ștergeți un rând, deplasați mouse-ul la unul dintre câmpurile din stânga și faceți clic pe butonul corespunzător.</p>
            <v-row>
                <v-col cols="12">
                    <v-data-table
                        class="size-table"
                        :headers="headers"
                        :items="sizes.slice(1)"
                        hide-default-footer
                        disable-sort
                    >
                        <template
                            v-for="i in headers.length"
                            #[getHeaderKey(i)]="{value}"
                        >
                            <v-input
                                class="h-100"
                                :rules="[() => requiredRule(sizes[0][i - 1]), () => differentHeaderRule(i - 1)]"
                            >
                                <div
                                    v-if="i != 1"
                                    class="size-inputs d-flex justify-center pt-3 w-100 h-100"
                                >
                                    <v-btn
                                        :class="{ loading: props.loading }"
                                        icon="mdi-plus"
                                        size="x-small"
                                        color="success"
                                        :elevation="0"
                                        @click="addColumn(i - 1)"
                                    />
                                    <input
                                        v-if="headers[i - 1].key != 'type'"
                                        v-model="sizes[0][i - 1]"
                                        class="size-input"
                                        :disabled="loading"
                                    />
                                    <v-btn
                                        v-if="sizes[0].length > 2"
                                        :class="{ loading: props.loading }"
                                        icon="mdi-delete"
                                        size="x-small"
                                        color="error"
                                        :elevation="0"
                                        @click="deleteColumn(i - 1)"
                                    />
                                </div>
                            </v-input>
                        </template>
                        <template
                            v-for="(header, headerIndex) in headers"
                            #[`item.${header.key}`]="{value, index}"
                        >
                            <div 
                                v-if="headerIndex == 0"
                                class="size-inputs pt-5 h-100 d-flex align-center"
                            >
                                <v-input
                                    class="h-100"
                                    :rules="[() => requiredRule(sizes[index + 1][0]), () => differentRowsRule(index + 1)]"
                                >
                                    <div>
                                        <v-btn
                                            :class="{ loading: props.loading, 'w-100': true }"
                                            icon="mdi-plus"
                                            size="x-small"
                                            height="25"
                                            color="success"
                                            :elevation="0"
                                            @click="addRow(index + 1)"
                                        />
                                        <input
                                            v-model="sizes[index + 1][0]"
                                            class="size-input"
                                            :disabled="loading"
                                        />
                                        <v-btn
                                            v-if="sizes.length > 2"
                                            :class="{ loading: props.loading, 'w-100': true }"
                                            icon="mdi-delete"
                                            size="x-small"
                                            height="25"
                                            color="error"
                                            :elevation="0"
                                            @click="deleteRow(index + 1)"
                                        />
                                    </div>
                                </v-input>
                            </div>
                            <div
                                v-else
                                class="pt-5 h-100 d-flex align-center"
                            >
                                <v-input :rules="[() => requiredRule(sizes[index + 1][headerIndex])]">
                                    <input
                                        v-model="sizes[index + 1][headerIndex]"
                                        :class="{ loading: props.loading, 'size-input': true }"
                                        :disabled="loading"
                                    />
                                </v-input>
                            </div>
                        </template>
                    </v-data-table>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script setup>
import { requiredRule } from '@/Helpers/ValidationRules';
import { ref, computed } from 'vue';

const sizes = defineModel();

const props = defineProps({
    loading: Boolean,
});

const headers = computed(() => {
    let emptyHeaderCount = 0;
    return sizeNames.value.map(sizeName => {
        if (sizeName) {
            return {
                key: sizeName,
                title: sizeName,
                sortable: false,
            };
        } else {
            ++emptyHeaderCount;
            return {
                key: 'empty' + emptyHeaderCount,
                title: 'empty' + emptyHeaderCount,
                sortable: false,
            };
        }
    });
});

const sizeNames = computed(() => {
    if (sizes.value.length > 0) {
        return sizes.value[0];
    } else {
        return [];
    }
});

function deleteColumn(columnNumber) {
    for (let sizeRow of sizes.value) {
        sizeRow.splice(columnNumber, 1);
    }
}

function addColumn(columnNumber) {
    for (let sizeRow of sizes.value) {
        sizeRow.splice(columnNumber, 0, null);
    }
}

function deleteRow(rowNumber) {
    sizes.value.splice(rowNumber, 1);
}

function addRow(rowNumber) {
    sizes.value.splice(rowNumber, 0, []);
}

function getHeaderKey(i) {
    return `header.${headers.value[i - 1]['key']}`;
}

function differentHeaderRule(indexToCheck) {
    for (let i = 0; i < sizes.value[0].length; ++i) {
        if (i != indexToCheck && sizes.value[0][i] == sizes.value[0][indexToCheck]) {
            return 'Această valoare există deja';
        }
    }
    
    return true;
}

function differentRowsRule(indexToCheck) {
    for (let i = 0; i < sizes.value.length; ++i) {
        if (i != indexToCheck && sizes.value[i][0] == sizes.value[indexToCheck][0]) {
            return 'Această valoare există deja';
        }
    }
    
    return true;
}
</script>

<style>
.size-table td, .size-table th {
    padding-left: 5px !important;
    padding-right: 5px !important;
}
.size-input {
    height: 32px !important;
    width: 100%;
    padding: 4px;
    border-bottom: 1px solid black;
    background-color: #F6F6F6;
    -webkit-background-clip: inherit;
}
.size-inputs button {
    display: none;
}
.size-inputs:hover button:not(.loading) {
    display: block;
}
</style>
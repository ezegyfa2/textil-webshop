<template>
    <v-input
        :rules="[() => form.products.length > 0 || 'Cel puțin un preț trebuie să fie stabilit']"
        error
    >
        <h2 class="text-h5 mt-12">Prețuri</h2>
    </v-input>
    <v-btn 
        text="Adaugă un preț nou"
        size="large"
        rounded="0"
        class="mt-3 mb-5"
        @click="addNewProduct"
    />
    <v-card
        v-for="(product, index) in form.products"
        class="mb-4"
    >
        <v-card-text>
            <v-row>
                <v-col
                    cols="12"
                    class="d-flex justify-space-between align-center"
                >
                    <p class="text-h6">Preț {{ index + 1 }}</p>
                    <v-btn 
                        rounded="0"
                        icon="mdi-delete-outline"
                        color="error"
                        size="small"
                        @click="deleteProduct(index)"
                    />
                </v-col>
            </v-row>
            <v-row class="justify-center">
                <v-col cols="12" sm="6">
                    <v-text-field
                        v-model="product.price"
                        label="Prețul"
                        type="number"
                        :rules="[requiredRule, numberRule, (value) => minRule(value, 0)]"
                        hide-spin-buttons
                        hide-details="auto"
                        required
                        :error-messages="form.errors[`products[${index}].price`]"
                    />
                </v-col>
                <v-col cols="12" sm="6">
                    <v-text-field
                        v-model="product.purchase_price"
                        label="Prețul de achiziție"
                        type="number"
                        :rules="[requiredRule, numberRule, (value) => minRule(value, 0)]"
                        hide-spin-buttons
                        hide-details="auto"
                        required
                        :error-messages="form.errors[`products[${index}].purchase_price`]"
                    />
                </v-col>
                <v-col cols="12">
                    <v-autocomplete
                        v-model="product.sizes"
                        :items="size_names"
                        :loading="form.processing"
                        :disabled="form.processing"
                        label="Dimensiuni"
                        name="sizes"
                        placeholder="Începeți să tastați pentru caută"
                        item-title="name"
                        item-value="id"
                        :error-messages="form.errors[`products[${index}].sizes`]"
                        required
                        outlined
                        hide-no-data
                        hide-details="auto"
                        no-filter
                        prepend-inner-icon="mdi-magnify"
                        return-object
                        clearable
                        chips
                        closable-chips
                        multiple
                    />
                </v-col>
            </v-row>
            <Colors
                :form="form"
                :product="product"
                :available_colors="available_colors"
            />
        </v-card-text>
    </v-card>
</template>

<script setup>
import Colors from '@/Components/Admin/Product/Colors.vue';
import { minRule, requiredRule, numberRule } from '@/Helpers/ValidationRules';
import { watch } from 'vue';

const form = defineModel();

const props = defineProps({
    size_names: Array,
    available_colors: Array,
});

watch(() => props.size_names, (newSizeNames, oldSizeNames) => {
    if (newSizeNames.length == oldSizeNames.length) {
        for (let product of form.value.products) {
            product.sizes = product.sizes.filter(size => newSizeNames.includes(size) || oldSizeNames.includes(size)).map(size => {
                if (!newSizeNames.includes(size)) {
                    return newSizeNames[oldSizeNames.indexOf(size)];
                } else {
                    return size;
                }
            });
        }
    } else {
        for (let product of form.value.products) {
            product.sizes = product.sizes.filter(size => newSizeNames.includes(size));
        }
    }
})

function addNewProduct() {
    form.value.products.push({
        price: null,
        purchase_price: null,
        sizes: [],
    });
}

function deleteProduct(productIndex) {
    form.value.products.splice(productIndex, 1);
}
</script>

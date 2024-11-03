<template>
    <MainLayout>
        <v-container class="product-show-container">
            <v-row>
                <v-col cols="12" sm="6" lg="8">
                    <ImageSection :image_sources="image_sources"/>
                </v-col>
                <v-col class="pl-md-15" cols="12" sm="6" lg="4">
                    <v-form ref="addToCartForm" @submit.prevent="addToCart">
                        <h1 class="text-h5 main-text mb-16">{{ name }}</h1>
                        <v-select
                            v-model="sizeId"
                            :items="availableSizes"
                            item-title="name"
                            item-value="id"
                            class="text-body-1 main-text"
                            label="Dimensiune"
                            placeholder="Dimensiune"
                            :rules="[requiredRule]"
                            :error-messages="errorMessages.size_id"
                        >
                            <template v-slot:item="{ props }">
                                <v-list-item v-bind="props">
                                    <template v-slot:title="{ title }">
                                        <p class="text-body-1 main-text">{{ title }}</p>
                                    </template>
                                </v-list-item>
                            </template>
                        </v-select>
                        <v-select
                            v-model="combinedColorId"
                            :items="availableCombinedColors"
                            item-title="name"
                            item-value="id"
                            class="text-body-1 main-text"
                            label="Culoare"
                            placeholder="Selectați culoarea"
                            :rules="[requiredRule]"
                            :error-messages="errorMessages.combined_color_id"
                        >
                            <template v-slot:item="{ item, props }">
                                <v-list-item v-bind="props">
                                    <template v-slot:title="{ title }">
                                        <div class="d-flex align-center">
                                            <div
                                                v-for="colorCode in item.raw.codes"
                                                class="mr-1 border-sm"
                                                :style="'height:20px;width:20px;background-color:#' + colorCode"
                                            >
                                            </div>
                                            <p class="ml-2 text-body-1 main-text">{{ title }}</p>
                                        </div>
                                    </template>
                                </v-list-item>
                            </template>
                        </v-select>
                        <div class="quantity-field d-flex align-start justify-between mb-5 w-100">
                            <v-btn
                                width="55"
                                height="55"
                                :disabled="quantity <= 1"
                                @click="decrease"
                            >
                                <p class="text-h4 main-text">-</p>
                            </v-btn>
                            <v-text-field
                                v-model="quantity"
                                @change="updateQuantity(item)"
                                type="number"
                                :rules="[(value) => minRule(value, 1), requiredRule]"
                                class="text-h6 main-text"
                                rounded="0"
                                hide-spin-buttons
                                center-affix
                            />
                            <v-btn
                                width="55"
                                height="55"
                                @click="++quantity"
                            >
                                <p class="text-h4 main-text">+</p>
                            </v-btn>
                        </div>
                        <div class="d-flex justify-between mb-2">
                            <p class="text-h6 main-text">Preț total:</p>
                            <p class="text-h6 main-text">{{ price }} RON</p>
                        </div>
                        <v-btn
                            width="100%"
                            height="55"
                            type="submit"
                        >
                            <p class="text-body-1 text-uppercase main-text">Adaugă în coș</p>
                        </v-btn>
                    </v-form>
                </v-col>
            </v-row>
            <v-row class="mt-16 mb-5">
                <v-col>
                    <h2 class="text-h4 main-text text-center mb-8">Caracteristicile technice</h2>
                    <v-divider
                        :thickness="1"
                        opacity="100"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="6" lg="4">
                    <v-container class="pt-0">
                        <v-row>
                            <v-col
                                class="d-flex justify-space-between align-end pb-0"
                                cols="12"
                            >
                                <p class="text-h6 main-text">Marca</p>
                                <p class="text-body-1">{{ brand }}</p>
                            </v-col>
                            <v-col
                                class="d-flex justify-space-between align-end pb-0"
                                cols="12"
                            >
                                <p class="text-h6 main-text">Categorie</p>
                                <p class="text-body-1">{{ category }}</p>
                            </v-col>
                            <v-col
                                class="d-flex justify-space-between align-end pb-0"
                                cols="12"
                            >
                                <p class="text-h6 main-text">g/m2</p>
                                <p class="text-body-1">{{ gram_per_m2 }}</p>
                            </v-col>
                            <v-col 
                                class="pb-0"
                                cols="12"
                            >
                                <div 
                                    v-if="fabric_properties.length > 0"
                                    class="d-flex justify-space-between align-end"
                                >
                                    <p class="text-h6 main-text">Material</p>
                                    <p class="text-body-1">{{ fabric_properties[0] }}</p>
                                </div>
                                <p
                                    v-if="fabric_properties.length > 0"
                                    v-for="i in fabric_properties.length - 1"
                                    class="text-end"
                                >
                                    {{ fabric_properties[i] }}
                                </p>
                            </v-col>
                            <v-col
                                class="pb-0"
                                cols="12"
                            >
                                <div 
                                    v-if="cut_properties.length > 0"
                                    class="d-flex justify-space-between align-end"
                                >
                                    <p class="text-h6 main-text">Taietura</p>
                                    <p class="text-body-1">{{ cut_properties[0] }}</p>
                                </div>
                                <p
                                    v-if="cut_properties.length > 0"
                                    v-for="i in cut_properties.length - 1"
                                    class="text-end"
                                >
                                    {{ cut_properties[i] }}
                                </p>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-col>
                <v-col cols="12" md="6" lg="8">
                    <v-card rounded="0">
                        <v-data-table
                            :items="orderedSizes"
                            hide-default-footer
                            disable-sort
                        >
                            <template v-slot:header.type></template>
                            <template v-slot:item.type="{ item }">
                                <p class="text-body-1 main-text">{{ item.type }}</p>
                            </template>
                        </v-data-table>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import ImageSection from '@/Components/User/Product/ImageSection.vue';
import { minRule, requiredRule } from '@/Helpers/ValidationRules';
import { distinct, distinctObjectsByProperty } from '@/Helpers/Helpers';
import { addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';
import { router } from '@inertiajs/vue3';
import { ref, computed, useTemplateRef } from 'vue';

const props = defineProps<{
    name: string,
    gram_per_m2: number,
    brand: string,
    category: string,
    image_sources: string[],
    fabric_properties: string[],
    cut_properties: string[],
    products: Object[],
    sizes: Object,
}>();

const combinedColorId = ref(null);
const sizeId = ref(null);
const quantity = ref(1);
const formComponent = useTemplateRef('addToCartForm');
const orderedSizes = computed(() => Object.entries(props.sizes).map(currentSize => Object.assign({type: currentSize[0]}, currentSize[1])));
const errorMessages = ref([]);

const availableSizes = computed(() => {
    let productsWithCorrespondingColor = props.products.filter(product => {
        const productCombinedColors = product.combined_colors.map(combinedColor => combinedColor.id);
        if (combinedColorId.value && !productCombinedColors.includes(combinedColorId.value)) {
            return false;
        } else {
            return true;
        }
    });
    const sizes = productsWithCorrespondingColor.map(product => product.sizes).flat();
    return distinctObjectsByProperty(sizes, 'id');
});
const availableCombinedColors = computed(() => {
    let productsWithCorrespondingSize = props.products.filter(product => {
        const productSizes = product.sizes.map(size => size.id);
        if (sizeId.value && !productSizes.includes(sizeId.value)) {
            return false;
        } else {
            return true;
        }
    });
    const colors = productsWithCorrespondingSize.map(product => product.combined_colors).flat();
    return distinctObjectsByProperty(colors, 'id');
});
const price = computed(() => {
    if (combinedColorId.value && sizeId.value && choosedProducts.value.length != 1) {
        addUnexpectedErrorNotification();
        throw new Error('Invalid choosed product count');
    } else {
        const prices = distinct(choosedProducts.value.map(product => product.price));
        if (prices.length == 1) {
            return (prices[0] * quantity.value).toFixed(2);
        } else {
            return null;
        }
    }
})
const choosedProducts = computed(() => props.products.filter(product => {
    const productSizes = product.sizes.map(size => size.id);
    console.log(productSizes)
    if (sizeId.value && !productSizes.includes(sizeId.value)) {
        return false;
    } else {
        const productCombinedColors = product.combined_colors.map(combinedColor => combinedColor.id);
        if (combinedColorId.value && !productCombinedColors.includes(combinedColorId.value)) {
            return false;
        } else {
            return true;
        }
    }
}));

async function addToCart() {
    const { valid } = await formComponent.value.validate();
    if (valid) {
        if (choosedProducts.value.length == 1) {
            router.post(route('cart.add-to-cart'), {
                product_id: choosedProducts.value[0].id,
                quantity: quantity.value,
                size_id: sizeId.value,
                combined_color_id: combinedColorId.value,
            }, {
                onError: (errors) => {
                    addUnexpectedErrorNotification();
                    errorMessages.value = errors;
                    console.log(errors);
                },
            });
        } else {
            addUnexpectedErrorNotification();
            throw new Error('Invalid choosed product count');
        }
    }
}

function decrease() {
    if (quantity.value > 1) {
        --quantity.value;
    }
}
</script>

<style lang="scss">
@import "@styles/themeVariables";

.product-show-container {
    margin-top: 100px;
    margin-bottom: 50px;
}
.product-show-divider {
    border-top-color: $secondary-color;
}
.quantity-field input {
    text-align: center;
}
th {
    font-size: 1rem !important;
    font-family: "Kanit" !important;
    font-weight: bolder !important;
    line-height: 1.5;
    letter-spacing: 0.03125em !important;
}
</style>

<template>
    <v-input
        :rules="[() => product.combined_colors.length > 0 || 'Cel puțin o culoare trebuie să fie setată']"
        error
    >
        <h2 class="text-h5 mt-12">Culorile</h2>
    </v-input>
    <v-btn 
        text="Adaugă o culoare nou"
        size="large"
        rounded="0"
        class="mt-3 mb-5"
        @click="product.combined_colors.push({ codes: [] })"
    />
    <v-row>
        <v-col
            v-for="(combinedColor, index) in product.combined_colors"
            cols="12" sm="6" md="4" lg="3"
        >
            <v-combobox
                v-model="product.combined_colors[index].codes"
                :items="available_colors"
                class="text-body-1 main-text"
                :label="'Culoare ' + (index + 1)"
                item-title="name"
                placeholder="Selectați culoarea"
                multiple
                :rules="[requiredRule]"
                :error-messages="form.errors[`products[]`]"
            >
                <template v-slot:selection="data">
                    <div
                        class="mr-1 border-sm"
                        :style="'height:20px;width:20px;background-color:#' + data.item.raw.code"
                    >
                    </div>
                </template>
                <template v-slot:item="{ props, item }">
                    <v-list-item v-bind="props">
                        <template v-slot:title>
                            <div class="d-flex align-center">
                            <div
                                class="mr-1 border-sm"
                                :style="'height:20px;width:20px;background-color:#' + item.raw.code"
                            >
                            </div>
                                <p class="ml-2 text-body-1 main-text">{{ item.raw.name }}</p>
                            </div>
                        </template>
                    </v-list-item>
                </template>
            </v-combobox>
        </v-col>
    </v-row>
</template>

<script setup>
import { requiredRule } from '@/Helpers/ValidationRules';

const props = defineProps({
    product: Object,
    form: Object,
    available_colors: Array,
});
</script>

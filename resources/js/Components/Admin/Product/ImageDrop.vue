<template>
    <div :class="[ (dragover && !loading) ? 'border-primary' : 'border-secondary', 'border-md', 'border-dashed', 'border-opacity-100', 'rounded-lg' ]">
        <v-container>
            <v-row class="align-center py-8 flex-column">
                <v-progress-circular
                    v-if="loading"
                    color="primary"
                    indeterminate
                />
                <v-icon
                    v-if="dragover && !loading" 
                    color="primary" 
                    size="75"
                >
                    mdi-plus
                </v-icon>
                <v-icon
                    v-if="!dragover && !loading" 
                    color="primary" 
                    size="75"
                >
                    mdi-cloud-outline
                </v-icon>
                <span
                    v-if="!loading"
                    class="title indigo--text text--darken-2"
                >
                    Húzza be a képeket a feltöltéshez!
                </span>
            </v-row>
            <v-row>
                <v-radio-group
                    v-model="mainImage"
                    inline
                >
                    <v-col
                        v-for="i in images.length"
                        cols="12" sm="6" md="4" lg="3"
                    >
                        <v-img
                            class="rounded-lg text-end"
                            :src="images[i - 1].url"
                            width="100%"
                            height="200"
                            cover
                        >
                            <v-btn
                                class="mt-2 mr-2"
                                icon="mdi-close"
                                color="error"
                                size="x-small"
                                :disabled="loading"
                                :loading="loading"
                                @click="() => removeImage(i - 1)"
                            />
                        </v-img>
                        <p
                            v-if="errors && errors[i - 1]?.url"
                            class="text-error"
                        >
                            {{ errors[i - 1].url }}
                        </p>

                        <v-radio
                            class="pt-1"
                            label="Alapértelmezett"
                            :value="getDefaultValue(i - 1)"
                        />

                        <v-text-field
                            v-model="images[i - 1].description"
                            class="pt-1"
                            label="Leírás"
                            :counter="255"
                            clearable
                            :rules="[maxFieldLengthRule]"
                            :disabled="loading"
                            :loading="loading"
                            :error-messages="errors ? errors[i - 1]?.description : null"
                        />
                    </v-col>
                    <v-col
                        v-if="loading"
                        v-for="progressValue in progressValues"
                        class="text-center"
                        cols="12" sm="6" md="4" lg="3"
                    >
                        <p class="text-body-1 mt-5">Kép feltöltése</p>
                        <p class="text-body-1 my-5">{{ progressValue }}%</p>
                        <v-progress-linear
                            :model-value="progressValue"
                        />
                    </v-col>
                </v-radio-group>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, getCurrentInstance } from 'vue';
import { addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';
import { maxFieldLengthRule } from '@/Helpers/ValidationRules';

const props = defineProps({
    label: String,
});

const loading = defineModel('loading');
const images = defineModel('images');
const mainImage = defineModel('mainImage');
const errors = defineModel('errors');
const dragover = ref(false);
const progressValues = ref([]);
let inDragoverTimeout = null;

function initializeEvents() {
    const dropZone = getCurrentInstance().subTree.el;

    dropZone.removeEventListener('dragenter', dragEnter);
    dropZone.addEventListener('dragenter', dragEnter);

    dropZone.removeEventListener('dragleave', dragLeave);
    dropZone.addEventListener('dragleave', dragLeave);

    dropZone.removeEventListener('dragover', dragOver);
    dropZone.addEventListener('dragover', dragOver);

    dropZone.removeEventListener('drop', drop);
    dropZone.addEventListener('drop', drop);
}

function dragEnter(e) {
    e.preventDefault();
    clearTimeout(inDragoverTimeout);
    dragover.value = true;
}

function dragLeave(e) {
    e.preventDefault();
    inDragoverTimeout = setTimeout(() => {
        dragover.value = false
    }, 50);
}

function dragOver(e) {
    e.preventDefault();
    clearTimeout(inDragoverTimeout);
    dragover.value = true;
}

function drop(e) {
    e.preventDefault();
    if (e.dataTransfer) {
        uploadFiles(e.dataTransfer.files);
    }
}

function uploadFiles(fileList) {
    dragover.value = false;
    let closedUploadedCount = 0;
    loading.value = true;
    for (let i = 0; i < fileList.length; ++i) {
        progressValues.value.push(0);
        let formData = new FormData();
        formData.append('image', fileList[i]);
        axios.post(route('admin.product.upload-image'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            onUploadProgress: function (progressEvent) {
                const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
                if (totalLength !== null) {
                    progressValues.value[i] = Math.round((progressEvent.loaded * 100) / totalLength);
                }
            },
        })
        .then((response) => {
            images.value.push({
                url: response.data,
            });
            if (images.value.length == 1) {
                mainImage.value = response.data;
            }
        })
        .catch((error) => {
            console.error(error);
            addUnexpectedErrorNotification(' a kép feltöltése közben');
        })
        .finally(() => {
            progressValues.value.splice(i, 1);
            ++closedUploadedCount;
            if (closedUploadedCount == fileList.length) {
                loading.value = false;
                progressValues.value = [];
            }
        });
    }
}

function removeImage(imageToRemoveIndex) {
    let imageId = images.value[imageToRemoveIndex].id;
    if (imageId) {
        loading.value = true;
        axios.delete(route('admin.product.delete-image', {
            productImage: imageId,
        }))
        .then((response) => {
            updateDefaultImageNumber(imageToRemoveIndex);
            images.value.splice(imageToRemoveIndex, 1);
        })
        .catch((error) => {
            console.error(error);
            addUnexpectedErrorNotification(' a kép feltöltése eltávolítása közben');
        })
        .finally(() => {
            loading.value = false;
        });
    } else {
        updateDefaultImageNumber(imageToRemoveIndex);
        images.value.splice(imageToRemoveIndex, 1);
    }
}

function updateDefaultImageNumber(imageToRemoveIndex) {
    if (mainImage.value === images.value[imageToRemoveIndex]?.id || mainImage.value === images.value[imageToRemoveIndex]?.url) {
        if (images.value.length > 1) {
            if (imageToRemoveIndex == 0) {
                mainImage.value = getDefaultValue(1);
            } else {
                mainImage.value = getDefaultValue(0);
            }
        } else {
            mainImage.value = null;
        }
    }
}

function getDefaultValue(i) {
    if (images.value[i]?.id) {
        return images.value[i].id;
    } else {
        return images.value[i]?.url;
    }
}

onMounted(initializeEvents);
onUpdated(initializeEvents);
</script>

<style scoped>
.uploader-section {
    border: 2px dashed #ccc;
}
</style>

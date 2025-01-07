<template>
    <div :class="[ (dragover && !loading) ? 'border-primary' : 'border-secondary', 'border-md', 'border-dashed', 'border-opacity-100' ]">
        <v-container>
            <v-row>
                <v-input
                    class="image-field"
                    :rules="[() => required ? requiredRule(image?.url) : true]"
                >
                    <v-col
                        class="d-flex align-center flex-column py-8"
                        cols="12"
                    >
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
                            Glisați și fixați imaginile pentru a le încărca!
                        </span>
                    </v-col>
                </v-input>
            </v-row>
            <v-row>
                <v-col
                    class="d-flex align-center flex-column"
                    cols="12"
                >
                    <v-img
                        v-if="image && image.url"
                        class="text-end"
                        :src="image.url"
                        width="100%"
                        cover
                    >
                        <v-btn
                            class="mt-2 mr-2"
                            icon="mdi-close"
                            color="error"
                            size="x-small"
                            :disabled="loading"
                            :loading="loading"
                            @click="() => removeImage()"
                        />
                    </v-img>
                    <p
                        v-if="errorMessages"
                        class="text-error"
                    >
                        {{ errorMessages.url }}
                    </p>
                </v-col>
                <v-col
                    v-if="progressValue"
                    class="text-center"
                    cols="12" sm="6" md="4" lg="3"
                >
                    <p class="text-body-1 mt-5">Încărcați o imagine</p>
                    <p class="text-body-1 my-5">{{ progressValue }}%</p>
                    <v-progress-linear
                        :model-value="progressValue"
                    />
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
import { ref, onMounted, onUpdated, getCurrentInstance } from 'vue';
import { addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';
import { requiredRule } from '@/Helpers/ValidationRules';

const props = defineProps({
    label: String,
    upload_url: String,
    delete_url: String,
    required: {
        type: Boolean,
        default: false,
    },
});

const loading = defineModel('loading');
const image = defineModel('image');
const errorMessages = defineModel('errorMessages');
const dragover = ref(false);
const progressValue = ref(0);
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
        uploadFile(e.dataTransfer.files);
    }
}

function uploadFile(fileList) {
    dragover.value = false;
    loading.value = true;
    progressValue.value = 1;
    let formData = new FormData();
    formData.append('image', fileList[0]);
    image.value = {};
    axios.post(route(props.upload_url), formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
        onUploadProgress: function (progressEvent) {
            const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
            if (totalLength !== null) {
                progressValue.value = Math.round((progressEvent.loaded * 100) / totalLength);
            }
        },
    })
    .then((response) => {
        image.value = {
            url: response.data,
        };
    })
    .catch((error) => {
        console.error(error);
        addUnexpectedErrorNotification(' a kép feltöltése közben');
    })
    .finally(() => {
        loading.value = false;
        progressValue.value = null;
    });
}

function removeImage() {
    let imageId = image.value.id;
    if (imageId) {
        loading.value = true;
        axios.delete(route(props.delete_url, {
            image: imageId,
        }))
        .then((response) => {
            image.value = {};
        })
        .catch((error) => {
            console.error(error);
            addUnexpectedErrorNotification(' a kép feltöltése eltávolítása közben');
        })
        .finally(() => {
            loading.value = false;
        });
    } else {
        image.value = {};
    }
}

onMounted(initializeEvents);
onUpdated(initializeEvents);
</script>

<style>
.uploader-section {
    border: 2px dashed #ccc;
    border-radius: 0;
}
.image-field .v-messages__message {
    text-align: center;
}
</style>

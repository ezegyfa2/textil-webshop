<template>
<span>
    <v-dialog
        v-model="localShow"
        max-width="600px"
    >
        <v-card>
            <v-card-title class="pa-4">
                {{ title }}
            </v-card-title>

            <v-card-text class="pa-4">
                {{ content }}
            </v-card-text>

            <v-card-actions class="d-flex justify-space-between pa-4">
                <v-btn
                    class="bg-primary"
                    color="surface"
                    type="button"
                    @click="cancel"
                >
                    Cancel
                </v-btn>
                <v-btn
                    type="button"
                    class="bg-error"
                    color="surface"
                    @click="confirm"
                >
                    {{ confirmButtonText }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</span>
</template>

<script lang="ts" setup>
import { ref, watch } from 'vue';

const props = defineProps({
    title: {
        type: String,
    },
    content: {
        type: String,
    },
    confirmButtonText: {
        type: String,
        default: 'Confirm',
    },
    show: {
        type: Boolean,
        default: false,
    }
});

const emit = defineEmits([ 'confirmed', 'update:show' ]);

let localShow = ref(props.show);
watch(localShow, async (newLocalShow: boolean) => {
    if (props.show.value != newLocalShow) {
        emit('update:show', newLocalShow);
    }
})
watch(() => props.show, async (newShow: boolean) => {
    if (localShow.value != newShow) {
        localShow.value = newShow;
    }
})

function confirm() {
    localShow.value = false;
    emit('confirmed');
}

function cancel() {
    localShow.value = false;
}
</script>
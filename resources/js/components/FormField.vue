<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <component :is="signaturePadComponent" :field="field" :showModal.sync="showModal">
                <VueSignaturePad
                    :id="field.name"
                    :class="errorClasses"
                    :options="{ onEnd: onSignatureEnd }"
                    ref="signaturePad"
                    class="form-input-bordered p-0"
                    :width="signaturePadWidth"
                    :height="signaturePadHeight"
                />

                <p class="mt-4">
                    <button @click.prevent="clearSignature" class="btn btn-default btn-danger cursor-pointer text-white ml-auto">Clear</button>
                </p>
            </component>

            <a class="edit-in-modal" v-if="field.editInModal" @click.prevent="doShowModal">
                <div class="edit-in-modal-canvas" v-if="field.value">
                    <img :src="field.value">
                </div>

                <button :class="{'flatten': field.value}" class="edit-in-modal-button btn btn-default btn-primary cursor-pointer text-white ml-auto">Edit</button>
            </a>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import SignaturePad from 'signature_pad';
import SpecialDiv from './SpecialDiv';
import SpecialModal from './SpecialModal';

export default {
    components: {
        'special-div': SpecialDiv,
        'special-modal': SpecialModal
    },

    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            showModal: false
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            if (this.field.value && ! this.field.editInModal) {
                this.fillSignature();
            }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.field.value || '');
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.field.value = value;
        },

        /**
         * Fill signature with data.
         */
        fillSignature() {
            this.$refs.signaturePad.fromDataURL(this.field.value);
        },

        /**
         * Clear Signature Pad.
         */
        clearSignature() {
            this.$refs.signaturePad.clearSignature();

            this.field.value = '';
        },

        /**
         * Handle signature on end.
         */
        onSignatureEnd(value) {
            let { isEmpty, data } = this.$refs.signaturePad.saveSignature();

            this.field.value = data;
        },

        /**
         * Show the modal.
         */
        doShowModal() {
            this.showModal = true;

            this.$nextTick(() => {
                this.fillSignature();
            });
        },
    },

    computed: {
        signaturePadComponent() {
            return this.field.editInModal ? 'special-modal' : 'special-div';
        },

        signaturePadWidth() {
            return this.field.editInModal ? '100%' : '600px';
        },

        signaturePadHeight() {
            return this.field.editInModal ? '870px' : '600px';
        }
    }
}
</script>

<style scoped>
    .edit-in-modal{
        display: block;
        width: 200px;
        cursor: pointer;
    }

    .edit-in-modal-canvas{
        border: 1px solid var(--60);
        border-bottom: 0;
        border-top-left-radius: .5rem;
        border-top-right-radius: .5rem;
    }

    .edit-in-modal-canvas img{
        display: block;
    }

    .edit-in-modal-button{
        width: 100%;
    }

    .edit-in-modal-button.flatten{
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

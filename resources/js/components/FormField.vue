<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <VueSignaturePad
                :id="field.name"
                :class="errorClasses"
                :options="{ onEnd: onSignatureEnd }"
                ref="signaturePad"
                class="form-input-bordered p-0"
                width="600px"
                height="600px"
            />

            <p class="mt-4">
                <button
                    @click.prevent="clearSignature"
                    class="btn btn-default btn-danger cursor-pointer text-white ml-auto"
                >Clear</button>
            </p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import SignaturePad from 'signature_pad';

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            if (this.field.value) {
                this.$refs.signaturePad.fromDataURL(this.field.value);
            }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '');
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value;
        },

        /**
         * Clear Signature Pad.
         */
        clearSignature() {
            this.$refs.signaturePad.clearSignature();
        },

        /**
         * Handle signature on end.
         */
        onSignatureEnd(value) {
            let { isEmpty, data } = this.$refs.signaturePad.saveSignature();

            this.value = data;
        },
    },
}
</script>

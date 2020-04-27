<template>
    <modal v-if="showModal">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 900px">
            <div class="bg-30 p-4 flex items-center justify-between">
                <div class="font-bold">{{ field.name }}</div>

                <button
                    @click.prevent="$emit('update:showModal', false)"
                    class="btn btn-default btn-primary"
                >Continue</button>
            </div>

            <div class="p-4">
                <slot></slot>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    props: ['field', 'showModal'],
}
</script>

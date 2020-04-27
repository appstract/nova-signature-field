<template>
    <div v-if="field.fullWidthOnDetail">
        <img v-if="field.value" :src="field.value">
        <span v-else>&mdash;</span>
    </div>

    <panel-item :field="field" v-else>
        <template v-slot:value>
            <div class="show-on-detail">
                <img v-if="field.value" :src="field.value">
            </div>
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>

<style scoped>
    .show-on-detail{
        border: 1px solid var(--60);
        border-radius: .5rem;
    }
</style>

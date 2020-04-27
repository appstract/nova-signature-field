<template>
    <div>
        <img v-if="field.value" :src="field.value" class="show-on-index">
        <span v-else>&mdash;</span>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>

<style scoped>
    .show-on-index{
        width: 30px;
        height: auto;
    }
</style>
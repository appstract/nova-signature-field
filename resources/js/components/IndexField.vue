<template>
    <div>
        <img
            v-if="field.value"
            :src="field.value"
            style="width: 30px; height: auto;"
        >

        <span v-else>-</span>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>

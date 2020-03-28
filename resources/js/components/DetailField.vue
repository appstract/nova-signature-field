<template>
    <div>
        <img
            v-if="field.value"
            :src="field.value"
        >

        <span v-else>-</span>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>

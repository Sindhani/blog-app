<script setup>

defineProps({
		blog: {
				type: Object,
				default: null,
				required: true
		}
})
</script>

<template>
		<div class="tw-text-base tw-font-normal tw-text-light-gray">
				{{ blog.excerpt }}
		</div>
</template>

<style scoped>

</style>
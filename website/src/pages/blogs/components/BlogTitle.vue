<script setup>
defineProps({
		title: {
				type: String,
				default: null,
				required: true
		}
})
</script>

<template>
		<div class="tw-text-[28px] tw-font-semibold">
				{{ title }}
		</div>
</template>

<style scoped>

</style>
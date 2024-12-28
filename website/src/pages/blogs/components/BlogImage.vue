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
		<div class="tw-w-[222px] tw-min-w-[222px] tw-max-w-[222px] ">
				<q-img :src="blog.image_url"/>
		</div>
</template>

<style scoped>

</style>
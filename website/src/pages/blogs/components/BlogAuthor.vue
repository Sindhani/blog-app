<script setup>
import PlaceholderAvatar from "components/PlaceholderAvatar.vue";

defineProps({
		blog: {
				type: Object,
				default: null,
				required: true
		}
})
</script>

<template>
		<div class="tw-flex tw-gap-x-1.5 tw-items-center">
				<div>
						<placeholder-avatar class="tw-w-[30px]"/>
				</div>
				<div class="tw-font-base tw-font-light">
						{{ blog.author?.name }}
				</div>
		</div>
</template>

<style scoped>

</style>
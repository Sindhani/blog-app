<script setup>
import PlaceholderAvatar from "components/PlaceholderAvatar.vue";
import {MdPreview} from 'md-editor-v3';
import 'md-editor-v3/lib/preview.css';

defineProps({
		comment: {
				type: Object,
				default: null,
				required: true
		}
})
</script>

<template>
		<div class="tw-flex tw-gap-x-2.5 tw-w-full tw-gap-y-2.5 tw-items-center tw-shadow-sm tw-my-2">
				<placeholder-avatar class="tw-w-[30px]"/>
				<div
						class="tw-p-2.5 tw-my-2.5 tw-drop-shadow-sm tw-w-[75%] tw-text-justify tw-text-base tw-font-light">
						<MdPreview :modelValue="comment.content"/>
				</div>
				<div class="tw-w-[15%]">
						{{ comment.created_at }}
				</div>
		</div>
</template>

<style scoped>

</style>
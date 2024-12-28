<script setup>
import {ref} from 'vue'

defineProps({
		blog: {
				type: Object,
				default: null,
				required: true
		}
})
const chats = ref(false)

</script>

<template>
		<div class="tw-flex tw-items-center tw-gap-x-5 tw-border-y tw-py-2.5 tw-w-full">
				<div class="tw-flex tw-items-center tw-gap-x-5">
						<div class="tw-flex tw-gap-1 tw-items-center">
								<q-icon name="mood"/>
								<div class="tw-text-base tw-font-normal tw-text-light-gray">300</div>
						</div>
						<div class="tw-flex tw-gap-1 tw-items-center">
								<q-icon name="thumb_up"/>
								<div class="tw-text-base tw-font-normal tw-text-light-gray">1.5K</div>
						</div>
						<div class="tw-flex tw-gap-1 tw-items-center tw-cursor-pointer"
								 @click="chats = !chats">
								<q-icon name="chat"/>
								<div class="tw-text-base tw-font-normal tw-text-light-gray">{{ blog.comments_count }}</div>
						</div>
				</div>
				<div class="tw-flex-grow tw-text-center tw-text-dark-gray tw-text-base">
						{{ blog.publish_date }}
				</div>
				<div class=" tw-flex tw-items-center tw-gap-x-2.5 tw-justify-end">
						<q-icon name="bookmark"></q-icon>
						<q-icon name="share"></q-icon>
				</div>

		</div>
</template>

<style scoped>

</style>
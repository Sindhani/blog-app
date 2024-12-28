<script setup>
import {ref} from 'vue'
import BlogComments from "pages/blogs/components/BlogComments.vue";

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
		<div class="tw-flex tw-items-center tw-gap-x-5">
				<div class="tw-flex tw-gap-1 tw-items-center">
						<q-icon name="mood"/>
						<div class="tw-text-base tw-font-normal tw-text-light-gray">{{ blog.reactions }}</div>
				</div>
				<div class="tw-flex tw-gap-1 tw-items-center">
						<q-icon name="thumb_up"/>
						<div class="tw-text-base tw-font-normal tw-text-light-gray">{{ blog.likes }}</div>
				</div>
				<div class="tw-flex tw-gap-1 tw-items-center tw-cursor-pointer"
						 @click="chats = !chats">

						<q-icon name="chat"/>
						<div class="tw-text-base tw-font-normal tw-text-light-gray">{{ blog.comments_count }}</div>
				</div>
		</div>
		<q-slide-transition :duration="300"
												appear>
				<blog-comments v-if="chats"
											 :blog="blog"/>
		</q-slide-transition>
</template>

<style scoped>

</style>
<script setup>
import {ref} from 'vue'
import CommentItem from "pages/blogs/components/CommentItem.vue";
import {useAuthStore} from "stores/useAuthStore.js";
import {useBlogStore} from "stores/useBlogStore.js";
import {MdEditor} from 'md-editor-v3';
import 'md-editor-v3/lib/style.css';

const props = defineProps({
		blog: {
				type: Object,
				required: true,
				default: null
		}
})
const comment = ref('')
const authStore = useAuthStore()
const blogStore = useBlogStore()
const addComment = () => {
		blogStore.addComment(props.blog.slug, comment.value)
		comment.value = null
}
</script>

<template>
		<div class="tw-ml-20 tw-my-5">
				<div class="tw-text-xl">
						Comments
				</div>
				<q-separator/>
				<comment-item v-for="(comment,index) in blog.comments"
											:key="index"
											:comment="comment"
				/>

				<div v-if="authStore.isAuthenticated"
						 class="tw-flex tw-flex-col tw-space-y-4 tw-my-4 tw-bg-white tw-rounded-lg">
						<div class="tw-text-2xl tw-font-semibold tw-text-gray-800">
								Add your Thoughts
						</div>
						<md-editor v-model="comment" class="tw-w-full tw-mx-auto" language="en" @keydown.ctrl.enter="addComment"/>
						<div>
								<div class="tw-italic">Ctrl + Enter to add comment</div>
						</div>
						<div v-if="blogStore.error" class="tw-text-red-500 tw-text-sm">
								{{ blogStore.error }}
						</div>
						<div class="tw-text-sm tw-text-gray-500 tw-text-center">
								Share your thoughts with us!
						</div>
				</div>

				<div v-else class="tw-p-6 tw-bg-white tw-rounded-lg tw-shadow-md tw-text-center">
						<div class="tw-text-xl tw-font-medium tw-text-gray-700">
								Login to add your thoughts
						</div>
				</div>
		</div>

</template>

<style scoped>

</style>
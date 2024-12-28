<script setup>
import {useBlogStore} from "stores/useBlogStore.js";
import {useRoute} from "vue-router";
import {computed} from "vue";
import BlogAuthor from "pages/blogs/components/BlogAuthor.vue";
import BlogDetailActions from "pages/blogs/components/BlogDetailActions.vue";
import BlogComments from "pages/blogs/components/BlogComments.vue";

const blogStore = useBlogStore()
const blog = computed(() => {
		return blogStore.blogDetail
})
const route = useRoute()
const get = async () => {
		await blogStore.fetchBlogDetail(route.params.blog)
}
get()
</script>

<template>
		<q-page padding>

				<q-btn color="primary" icon="arrow_back" outline @click="$router.push({name:'blogs.index'})">Back</q-btn>

				<div v-if="blog" class="tw-container tw-mx-auto tw-flex tw-justify-center tw-px-64">
						<q-card class="tw-w-min-w-[90%] tw-w-[100%]" flat>
								<q-card-section class="tw-text-[35px] tw-px-0">
										{{ blog.title }}
								</q-card-section>
								<q-card-section>
										<div class="tw-drop-shadow-md tw-border-2 tw-p-4 ">
												<q-img :src="blog.image_url" width="200"></q-img>

										</div>
								</q-card-section>
								<q-card-section class="tw-px-0">
										<blog-author :blog="blog"/>
								</q-card-section>
								<q-card-actions class="tw-px-0">
										<blog-detail-actions :blog="blog"/>
								</q-card-actions>
								<q-card-section class="tw-px-0 tw-text-justify">
										{{ blog.content }}
								</q-card-section>
								<q-card-section>
										<blog-comments :blog="blog" class="tw-ml-1"/>
								</q-card-section>
						</q-card>
				</div>

		</q-page>
</template>

<style scoped>

</style>
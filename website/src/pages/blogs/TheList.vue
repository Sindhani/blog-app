<script setup>
import TheBlog from "pages/blogs/TheBlog.vue";
import {useBlogStore} from 'stores/useBlogStore.js';
import {computed, onMounted} from 'vue';
import {Loading} from "quasar";

const blogStore = useBlogStore();

const loadMore = async () => {
		Loading.show()
		await blogStore.fetchBlogs(blogStore.currentPage + 1);
		Loading.hide()
};

const hasMore = computed(() => blogStore.currentPage < blogStore.totalPages);

onMounted(() => {
		blogStore.fetchBlogs(1);
});
</script>

<template>
		<q-page padding>
				<q-infinite-scroll
						:disable="!hasMore || blogStore.isLoading"
						:offset="200"
						@load="loadMore"
				>
						<the-blog v-for="(blog,index) in blogStore.blogs"
											:key="index"
											:blog="blog"

						/>
				</q-infinite-scroll>
				<q-spinner v-if="blogStore.isLoading"/>
				<q-banner v-if="blogStore.error" color="negative">
						{{ blogStore.error }}
				</q-banner>
		</q-page>


</template>

<style scoped>

</style>
<script setup>
import BlogTitle from "pages/blogs/components/BlogTitle.vue";
import BlogExcerpt from "pages/blogs/components/BlogExcerpt.vue";
import BlogImage from "pages/blogs/components/BlogImage.vue";

defineProps({
		blog: {
				type: Object,
				default: null,
				required: true
		}
})
</script>

<template>
		<div class="tw-grid tw-grid-cols-12">
				<div class="tw-col-span-8 tw-flex tw-flex-col tw-gap-y-2.5">
						<blog-title :title="blog.title"
												class="tw-col-span-8 tw-cursor-pointer"
												@click="$router.push({name:'blogs.show',params:{blog: blog.slug}})"/>
						<blog-excerpt :blog="blog"/>
				</div>
				<div class="tw-col-span-4">
						<blog-image :blog="blog"/>
				</div>

		</div>
</template>

<style scoped>

</style>
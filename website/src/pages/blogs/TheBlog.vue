<script setup>
import BlogMenu from "pages/blogs/components/BlogMenu.vue";
import BlogAuthor from "pages/blogs/components/BlogAuthor.vue";
import BlogDetail from "pages/blogs/components/BlogDetail.vue";
import BlogActions from "pages/blogs/components/BlogActions.vue";

defineProps({
		blog: {
				type: Object,
				default: null,
				required: true
		}
})
</script>

<template>
		<q-card class="tw-rounded-md tw-px-6 tw-my-2.5"

						flat>
				<q-card-section class="tw-flex tw-justify-between tw-items-center tw-py-1 tw-m-0">
						<blog-author :blog="blog"/>
						<blog-menu :blog="blog"/>
				</q-card-section>
				<q-card-section class="tw-py-1">
						<blog-detail :blog="blog"/>
				</q-card-section>
				<q-card-section>
						<blog-actions :blog="blog"/>
				</q-card-section>
		</q-card>
		<q-separator/>
</template>

<style scoped>

</style>
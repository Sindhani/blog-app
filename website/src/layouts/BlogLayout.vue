<template>
		<q-layout view="lHh Lpr lFf">
				<the-header/>
				<q-page-container class="tw-container tw-mx-auto">
						<router-view/>
				</q-page-container>
				<q-footer
						class="tw-bg-off-white tw-px-[75px] tw-py-[10px] tw-border tw-t-border"
				>
						<the-blog-footer/>
				</q-footer>
		</q-layout>
</template>


<script setup>
import TheHeader from "components/TheHeader.vue";
import TheBlogFooter from "components/ThBlogFooter.vue";
</script>

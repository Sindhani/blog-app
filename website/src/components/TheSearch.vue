<script setup>

import {useRouter} from 'vue-router';
import {useSearchStore} from "stores/useSearchStore.js";

const searchStore = useSearchStore();
const router = useRouter();

// Search input handler
const onSearchInput = () => {
		searchStore.performSearch();
};

// Redirect to the blog detail page
const goToDetailPage = (result) => {
		searchStore.results = []
		searchStore.query = null
		router.push({name: 'blogs.show', params: {blog: result._source.slug}});

};
</script>

<template>
		<div class="tw-relative">
				<q-input
						v-model="searchStore.query"
						class="tw-w-[300px]"
						dense
						outlined
						placeholder="Search..."
						@update:model-value="onSearchInput"
				>
						<template #prepend>
								<q-icon name="search"/>
						</template>
				</q-input>

				<!-- Search Results List -->
				<div
						v-if="searchStore.results.length && !searchStore.loading"
						class="tw-absolute tw-left-0 tw-right-0 tw-mt-1 tw-max-h-60 tw-overflow-y-auto tw-bg-white tw-border tw-rounded-lg tw-shadow-lg tw-z-10"
				>
						<ul class="tw-divide-y tw-divide-gray-200">
								<li
										v-for="result in searchStore.results"
										:key="result._id"
										class="tw-cursor-pointer tw-p-2 tw-hover:bg-gray-100"
										@click="goToDetailPage(result)"
								>
										<p class="tw-font-semibold">{{ result._source.title }}</p>
										<p class="tw-text-sm tw-text-gray-500">{{ result._source.excerpt }}</p>
								</li>
						</ul>
				</div>

				<!-- No Results or Error Message -->
				<div v-else-if="!searchStore.loading && searchStore.results.length === 0 && searchStore.query"
						 class="tw-flex tw-gap-x-2.5 tw-absolute tw-top-12 tw-justify-center tw-text-center">
						<q-icon name="search_off" size="sm"/>
						<div>No results found</div>
				</div>

				<q-banner v-if="searchStore.error" color="negative" dense>
						{{ searchStore.error }}
				</q-banner>
		</div>
</template>


<style scoped>

</style>
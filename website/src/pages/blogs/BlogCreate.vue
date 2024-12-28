<script setup>
import {reactive} from "vue";
import Form from "vform";
import {route} from "boot/ziggy.js";
import {Notify} from "quasar";

const form = reactive(new Form({
		title: null,
		excerpt: null,
		content: null,
		is_scheduled: false,
		publish_date: null,
		publish_time: null,
		keywords: [],
		seo_metadata: {meta_title: '', meta_description: null},
		image: null
}))
const post = async () => {
		try {
				const {data} = await form.post(route('user.blogs.store'))
				form.reset()
				Notify.create({message: data.message, position: 'center', color: 'positive'})
		} catch (e) {
				console.log(e.message)
		}

}
</script>

<template>
		<div class="tw-container tw-mx-auto tw-px-10 tw-py-2 tw-flex tw-justify-center">
				<q-card class="tw-w-[70%]">
						<q-card-section class="tw-text-xl tw-font-normal tw-text-dark-gray tw-bg-light-gray">
								Create Post
						</q-card-section>
						<q-card-section class="tw-flex tw-justify-between tw-gap-x-2.5 tw-py-1">
								<q-input v-model="form.title"
												 :error="form.errors.has('title')"
												 :error-message="form.errors.get('title')"
												 class="tw-w-full" dense label="Title"
												 outlined></q-input>
								<q-input v-model="form.excerpt"
												 :error="form.errors.has('excerpt')"
												 :error-message="form.errors.get('excerpt')"
												 class="tw-w-full"
												 dense
												 label="Excerpt"
												 outlined
								></q-input>
						</q-card-section>
						<q-card-section class="tw-py-0.5">
								<q-select v-model="form.keywords" :error="form.errors.has('keywords')"
													:error-message="form.errors.get('keywords')" dense label="Keywords" multiple
													new-value-mode="add-unique"
													outlined
													use-chips
													use-input></q-select>
						</q-card-section>
						<q-card-section class="tw-py-1">
								<q-input v-model="form.content" :error="form.errors.has('content')"
												 :error-message="form.errors.get('content')" dense label="Contents"
												 outlined
												 type="textarea"
								></q-input>
						</q-card-section>
						<q-card-section class="tw-flex tw-gap-x-2.5 tw-py-1">
								<q-input v-model="form.seo_metadata.meta_title"
												 :error="form.errors.has('seo_metadata')"
												 :error-message="form.errors.get('seo_metadata')" class="tw-w-full" dense
												 label="SEO Meta title"
												 outlined
								></q-input>
								<q-input v-model="form.seo_metadata.meta_description"
												 :error="form.errors.has('seo_metadata')"
												 :error-message="form.errors.get('seo_metadata')"
												 class="tw-w-full" dense label="SEO Meta Description"
												 outlined
								></q-input>
						</q-card-section>
						<q-card-section class="tw-flex tw-gap-x-2.5 tw-py-1">
								<q-file v-model="form.image"
												:error="form.errors.has('image')"
												:error-message="form.errors.get('image')"
												dense
												label="Upload Image"
												outlined
								></q-file>
						</q-card-section>
						<q-card-section class="tw-flex tw-gap-x-5">
								<q-toggle v-model="form.is_scheduled" label="Schedule Post ? "/>
								<q-input
										v-if="form.is_scheduled"
										v-model="form.publish_date"
										dense
										label="Schedule Date"
										outlined
										@click="() => $refs.qgenDateProxy.show()"
								>
										<template #prepend>
												<q-icon class="cursor-pointer" name="event">
														<q-popup-proxy ref="qgenDateProxy" transition-hide="scale" transition-show="scale">
																<q-date
																		v-model="form.publish_date"
																		mask="DD/MM/YYYY"
																		@update:model-value="() => {$refs.qgenDateProxy.hide()}"
																/>
														</q-popup-proxy>
												</q-icon>
										</template>
								</q-input>
								<q-input v-if="form.is_scheduled" v-model="form.publish_time" :rules="['time']"
												 dense
												 label="Schedule Time"
												 mask="time"
												 outlined
								>
										<template v-slot:append>
												<q-icon class="cursor-pointer" name="access_time">
														<q-popup-proxy cover transition-hide="scale" transition-show="scale">
																<q-time v-model="form.publish_time">
																		<div class="row items-center justify-end">
																				<q-btn v-close-popup color="primary" flat label="Close"/>
																		</div>
																</q-time>
														</q-popup-proxy>
												</q-icon>
										</template>
								</q-input>

						</q-card-section>
						<q-card-actions align="right">
								<q-btn color="info" no-caps no-wrap @click="$router.push('/')"> Cancel</q-btn>
								<q-btn :loading="form.busy" color="positive" no-caps @click="post">Create</q-btn>
						</q-card-actions>
				</q-card>
		</div>
</template>

<style scoped>

</style>
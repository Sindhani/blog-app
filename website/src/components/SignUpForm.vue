<script setup>
import {reactive} from "vue";
import {route} from "boot/ziggy.js";
import Form from "vform";
import {Notify} from "quasar";

const form = reactive(new Form({
		email: null,
		name: null,
}))
const emit = defineEmits(['signIn'])
const register = async () => {
		const {data} = await form.post(route('auth.register'))
		Notify.create({
				message: data.message,
				position: 'top-right',
				color: 'positive',
		})
		emit('signIn')
}
</script>

<template>
		<q-card class="tw-border tw-rounded-[13px] tw-min-w-[492px] tw-w-[492px] tw-px-5 tw-py-[17px]">
				<q-card-section class="tw-px-0 tw-flex tw-justify-between">
						<div class="spirax tw-text-[56px] tw-font-light">
								Blog App
						</div>
						<div class="tw-place-items-start">
								<q-icon v-close-popup
												class="tw-text-dark-gray tw-cursor-pointer"
												name="close"
												size="sm"/>
						</div>
				</q-card-section>
				<q-card-section class="tw-p-0 tw-text-base tw-text-dark-gray tw-m-0">
						Show the world your emotions in words.
				</q-card-section>
				<q-card-section class="tw-flex tw-flex-col tw-gap-y-[30px]">
						<div class="tw-flex tw-flex-col tw-gap-y-2.5">
								<div class="tw-text-base tw-font-normal">
										Name
								</div>
								<div>
										<q-input v-model="form.name"
														 :error="form.errors.has('name')"
														 :error-message="form.errors.get('name')"
														 dense
														 outlined/>
								</div>
						</div>
						<div class="tw-flex tw-flex-col tw-gap-y-2.5">
								<div class="tw-text-base tw-font-normal">
										Email Address
								</div>
								<div>
										<q-input v-model="form.email"
														 :error="form.errors.has('email')"
														 :error-message="form.errors.get('email')"
														 dense
														 outlined/>
								</div>
						</div>
				</q-card-section>
				<q-card-section class="tw-p-0 tw-m-0">
						<q-btn :loading="form.busy"
									 class="tw-rounded-md tw-w-full tw-bg-dark-gray tw-text-white"
									 noCaps
									 noWrap
									 @click="register">Sign up
						</q-btn>
				</q-card-section>
				<q-card-section class="tw-mt-6 tw-p-0 tw-text-center tw-pb-2">
						<div class="tw-text-base tw-font-normal">
								Already Have An Account ? <span class="tw-underline tw-cursor-pointer"
																								@click="$emit('signIn')">Sign in</span>
						</div>
				</q-card-section>
		</q-card>
</template>

<style scoped>

</style>
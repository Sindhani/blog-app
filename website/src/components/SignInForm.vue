<script setup>
import {reactive, ref} from "vue";
import Form from 'vform'
import {route} from "boot/ziggy.js";
import {useAuthStore} from "stores/useAuthStore.js";
import OtpInput from "components/OtpInput.vue";

const store = useAuthStore()
const authStore = useAuthStore()
const form = reactive(new Form({
		email: null,
		otp: Array(6).fill(""),
}));
const otpSent = ref(false)
const emit = defineEmits(["signUp", 'hide']);
const error = ref('')
const sendOtp = () => {
		authStore.sendOtp(form.email).then(() => {
				otpSent.value = true
				error.value = null
		}).catch((e) => {
				error.value = e.response.data.message
		})
}
const login = async () => {
		const {data} = await form.post(route('auth.login')).catch((e) => {
				error.value = e.response.data.message
		})
		await store.setToken(data.access_token)
		emit('hide')
}

</script>

<template>
		<q-card
				class="tw-border tw-rounded-[13px] tw-min-w-[492px] tw-w-[492px] tw-px-5 tw-py-[17px]"

		>
				<q-card-section class="tw-px-0 tw-flex tw-justify-between">
						<div class="spirax tw-text-[56px] tw-font-light">Blog App</div>
						<div class="tw-place-items-start">
								<q-icon
										v-close-popup
										class="tw-text-dark-gray tw-cursor-pointer"
										name="close"
										size="sm"
								/>
						</div>
				</q-card-section>
				<q-card-section class="tw-p-0 tw-text-base tw-text-dark-gray tw-m-0">
						Inspire Someone by your Stories and Writing
				</q-card-section>
				<q-card-section v-if="error" class="tw-text-red-500 tw-text-sm">
						{{ error }}
				</q-card-section>
				<q-card-section class="tw-flex tw-flex-col tw-gap-y-[30px]">
						<div class="tw-flex tw-flex-col tw-gap-y-2.5">
								<div class="tw-text-base tw-font-normal">Email Address</div>
								<div>
										<q-input v-model="form.email"
														 :error="form.errors.has('email')"
														 :error-message="form.errors.get('email')"
														 dense
														 outlined/>
								</div>
						</div>
						<div v-if="otpSent" class="tw-flex tw-flex-col tw-gap-y-2.5">
								<div class="tw-text-base tw-font-normal">OTP</div>
								<div class="tw-flex tw-flex-col tw-gap-y-[5px]">
										<otp-input v-model="form.otp"/>
								</div>
						</div>
				</q-card-section>
				<q-card-section class="tw-p-0 tw-m-0">
						<q-btn
								v-if="!otpSent"
								class="tw-rounded-md tw-w-full tw-bg-dark-gray tw-text-white"
								noCaps
								noWrap
								@click="sendOtp"
						>Send OTP
						</q-btn>
						<q-btn
								v-if="otpSent"
								:loading="form.busy"
								class="tw-rounded-md tw-w-full tw-bg-dark-gray tw-text-white"
								noCaps
								noWrap
								@click="login"
						>Sign in
						</q-btn>
				</q-card-section>
				<q-card-section class="tw-mt-6 tw-p-0 tw-text-center tw-pb-2">
						<div class="tw-text-base tw-font-normal">
								Don’t Have An Account ?
								<span class="tw-underline tw-cursor-pointer"
											@click="$emit('signUp')"
								>Sign up</span
								>
						</div>
				</q-card-section>
		</q-card>
</template>

<style scoped></style>

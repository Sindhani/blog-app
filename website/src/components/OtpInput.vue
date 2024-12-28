<template>
		<div class="tw-flex tw-justify-center tw-space-x-2">
				<input
						v-for="(otpDigit, index) in otp"
						:id="`otp${index}`"
						:key="index"
						:ref="'otp' + index"
						v-model="otp[index]"
						class="tw-w-12 tw-h-12 tw-text-center tw-border tw-border-gray-300 tw-rounded-md tw-text-lg focus:tw-outline-none focus:tw-border-blue-500"
						maxlength="1"
						@update:model-value="handleInput(index, $event)"
						@keydown.backspace="handleBackspace(index, $event)"
				/>
		</div>
</template>

<script setup>

const otp = defineModel({default: Array(6).fill("")})
// OTP array for six characters


// Handle input: Move to next input field after entering a character
const handleInput = (index, event) => {
		if (event.length === 1) {
				const nextInput = document.getElementById(`otp${index + 1}`);
				if (nextInput) {
						nextInput.focus();
				}
		}
};

// Handle backspace: Move to previous input field if current is empty
const handleBackspace = (index) => {
		if (!otp.value[index] && index > 0) {
				const prevInput = document.getElementById(`otp${index - 1}`);
				if (prevInput) {
						prevInput.focus();
				}
		}
};
</script>

<style scoped>
/* Add scoped styles if necessary */
</style>
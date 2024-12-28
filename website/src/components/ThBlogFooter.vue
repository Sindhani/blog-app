<script setup>
const menu = ["Our Team", "Contact", "About", "Terms", "Help"];
</script>

<template>
		<q-toolbar flat>
				<q-space/>
				<div
						class="tw-flex tw-gap-x-[54px] tw-items-center tw-font-light tw-text-dark-gray tw-justify-end"
				>
						<div v-for="(item, index) in menu"
								 :key="index"
								 class="tw-text-base">
								{{ item }}
						</div>
				</div>
		</q-toolbar>
</template>

<style scoped></style>

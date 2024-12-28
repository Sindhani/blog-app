<script setup>
import {useAuthStore} from "stores/useAuthStore.js";

const menu = [
		{icon: 'person', label: 'Profile'},
		{icon: 'title', label: 'Your Posts'},
		{icon: 'settings', label: 'Settings'},
]
const store = useAuthStore()
</script>

<template>
		<q-icon class="tw-p-1 tw-rounded-full tw-bg-light-gray tw-cursor-pointer" name="person" size="sm">
				<q-menu :offset="[10, 50]"
								anchor="bottom end"
								class="tw-w-[300px] tw-border tw-border-light-gray"
								fit
								self="top end">
						<q-list v-for="(item,index) in menu"
										:key="index">
								<q-item class="tw-px-7 tw-py-[15px]"
												clickable>
										<q-item-section avatar
																		class="tw-mr-5">
												<q-icon :name="item.icon"
																size="sm"/>
										</q-item-section>
										<q-item-section class="tw-font-light tw-text-xl">
												{{ item.label }}
										</q-item-section>
								</q-item>
						</q-list>
						<q-separator/>
						<q-list separator>
								<q-item class="tw-px-7 tw-py-[15px]"
												clickable>
										<q-item-section avatar
																		class="tw-mr-5">
												<q-icon color="red"
																name="login"
																size="sm"/>
										</q-item-section>
										<q-item-section class="tw-font-bold tw-text-lg "
																		@click="store.logout()"
										>
												<q-item-label class="tw-text-red-500"
																			header>
														Sign out
												</q-item-label>
												<q-item-label caption
																			class="tw-text-red-500"
																			lines="2"
												>{{ store.user.email }}
												</q-item-label>
										</q-item-section>

								</q-item>
						</q-list>
				</q-menu>
		</q-icon>
</template>

<style scoped>

</style>
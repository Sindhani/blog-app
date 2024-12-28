<script setup>
import BlackRoundedBtn from "components/BlackRoundedBtn.vue";
import SignInForm from "components/SignInForm.vue";
import {ref, watch} from "vue";
import SignUpForm from "components/SignUpForm.vue";
import UserProfile from "components/UserProfile.vue";
import {useAuthStore} from "stores/useAuthStore.js";
import {useSearchStore} from "stores/useSearchStore.js";
import TheSearch from "components/TheSearch.vue";

const store = useAuthStore()
const modalForm = ref('sign-in')

const menu = [
		{label: 'Features', to: {name: 'home'}},
		{label: 'Contact Team', to: {name: 'home'}},
]
const signInDialog = ref(false)
const searchStore = useSearchStore()
watch(() => searchStore.query, () => {
		searchStore.performSearch()
		console.log(searchStore.results)
})
</script>

<template>
		<q-header class="tw-bg-off-white tw-px-[75px] tw-py-[34px] tw-border tw-b-border">
				<q-toolbar flat>
						<q-toolbar-title class="tw-text-black spirax tw-italic tw-text-[56px] tw-cursor-pointer"
														 @click="$router.push('/')">
								Blog App
						</q-toolbar-title>

						<div class="tw-flex tw-gap-x-[30px] tw-items-center  tw-font-light tw-text-black tw-justify-center ">
								<the-search class="tw-mr-2.5"></the-search>

								<template v-for="(item,index) in menu"
													:key="index">
										<router-link
												:to="item.to"
												class="tw-text-xl">{{ item.label }}
										</router-link>

								</template>
								<router-link
										v-if="store.isAuthenticated"
										:to="{name:'blogs.create'}"
										class="tw-text-xl"> Write
								</router-link>
								<black-rounded-btn v-if="!store.isAuthenticated"
																	 label="Sign in"
																	 @click="signInDialog = true"/>
								<user-profile v-if="store.isAuthenticated"/>
						</div>
				</q-toolbar>
		</q-header>
		<q-dialog v-model="signInDialog">
				<sign-in-form v-if="modalForm === 'sign-in'"
											@hide="signInDialog = false"
											@sign-up="modalForm = 'sign-up'"/>
				<sign-up-form v-else
											@hide="signInDialog = false"
											@sign-in="modalForm = 'sign-in'"/>
		</q-dialog>
</template>

<style scoped>

</style>
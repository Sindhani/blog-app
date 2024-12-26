<script setup>
import BlackRoundedBtn from "components/BlackRoundedBtn.vue";
import SignInForm from "components/SignInForm.vue";
import {ref} from "vue";
import SignUpForm from "components/SignUpForm.vue";
const modalForm = 'sign-in'
const menu = [
    'Features',
    'Contact Team',
    'Write',
]
const signInDialog = ref(false)
</script>

<template>
  <q-header class="tw-bg-off-white tw-px-[75px] tw-py-[34px] tw-border tw-b-border">
    <q-toolbar flat>
      <q-toolbar-title class="tw-text-black spirax tw-italic tw-text-[56px]">
        Blog App
      </q-toolbar-title>

     <q-space>  </q-space>
      <div class="tw-flex tw-gap-x-[50px] tw-items-center  tw-font-light tw-text-black tw-justify-center ">
        <div class="tw-text-xl" v-for="(item,index) in menu" :key="index">{{ item }}</div>
        <black-rounded-btn label="Sign in" @click="signInDialog = true"/>
      </div>
    </q-toolbar>
  </q-header>
  <q-dialog v-model="signInDialog">
    <sign-in-form v-if="modalForm === 'sign-in'" @sign-up="modalForm = 'sign-up'"/>
    <sign-up-form v-else @sign-in="modalForm = 'sign-in'" />
  </q-dialog>
</template>

<style scoped>

</style>
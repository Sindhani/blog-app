<script setup>
import {ref} from "vue";

const form = ref({
  email:'',
  password:null,
  password_confirmation:null
})
const visibility = ref(false)
const confirmationVisibility = ref(false)
defineEmits(['signIn'])
</script>

<template>
<q-card class="tw-border tw-rounded-[13px] tw-min-w-[492px] tw-w-[492px] tw-px-5 tw-py-[17px]">
  <q-card-section class="tw-px-0 tw-flex tw-justify-between">
    <div class="spirax tw-text-[56px] tw-font-light">
      Blog App
    </div>
    <div class="tw-place-items-start">
      <q-icon name="close" size="sm" class="tw-text-dark-gray tw-cursor-pointer" v-close-popup></q-icon>
    </div>
  </q-card-section>
  <q-card-section class="tw-p-0 tw-text-base tw-text-dark-gray tw-m-0">
    Show the world your emotions in words.
  </q-card-section>
  <q-card-section class="tw-flex tw-flex-col tw-gap-y-[30px]">
    <div class="tw-flex tw-flex-col tw-gap-y-2.5">
      <div class="tw-text-base tw-font-normal">
        Email Address
      </div>
      <div>
        <q-input outlined v-model="form.email" dense></q-input>
      </div>

    </div>
    <div class="tw-flex tw-flex-col tw-gap-y-2.5">
      <div class="tw-text-base tw-font-normal">
      Password
      </div>
      <div class="tw-flex tw-flex-col tw-gap-y-[5px]">
        <q-input outlined v-model="form.password" :type="visibility ? 'text':'password'" dense>
          <template #append>
            <q-icon :name="visibility ? 'visibility': 'visibility_off'" @click="visibility = !visibility"></q-icon>
          </template>
        </q-input>
      </div>
    </div>
    <div class="tw-flex tw-flex-col tw-gap-y-2.5">
      <div class="tw-text-base tw-font-normal">
      Confirm Password
      </div>
      <div class="tw-flex tw-flex-col tw-gap-y-[5px]">
        <q-input outlined v-model="form.password_confirmation" :type="confirmationVisibility ? 'text':'password'" dense>
          <template #append>
            <q-icon :name="confirmationVisibility ? 'visibility': 'visibility_off'" @click="confirmationVisibility = !confirmationVisibility"></q-icon>
          </template>
        </q-input>
      </div>
    </div>
  </q-card-section>
  <q-card-section class="tw-p-0 tw-m-0">
    <q-btn class="tw-rounded-md tw-w-full tw-bg-dark-gray tw-text-white" no-wrap no-caps >Sign up</q-btn>
  </q-card-section>
  <q-card-section class="tw-mt-6 tw-p-0 tw-text-center tw-pb-2">
    <div class="tw-text-base tw-font-normal">
      Already Have An Account ? <span class="tw-underline tw-cursor-pointer" @click="$emit('signIn')">Sign in</span>
    </div>
  </q-card-section>
</q-card>
</template>

<style scoped>

</style>
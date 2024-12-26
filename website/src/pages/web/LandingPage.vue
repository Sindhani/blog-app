<script setup>

import BlackRoundedBtn from "components/BlackRoundedBtn.vue";
</script>

<template>
<div class="tw-grid tw-grid-cols-12 tw-px-[80px] tw-py-[80px] tw-gap-x-[19.6px]">
  <div class="tw-w-full tw-flex tw-justify-between tw-items-center tw-col-span-6">
    <q-img src="~/assets/images/home-page-img.svg" class="tw-w-full" fit="cover"></q-img>
  </div>
  <div class="tw-flex tw-flex-col tw-col-span-6">
    <div class="tw-text-[72px] tw-font-bold scheherazadenew-bold">Unveil Thoughts </div>
    <div class="tw-text-[72px] tw-font-bold tw-text-right tw-underline scheherazadenew-bold">Voice Yours</div>
    <div class="tw-mt-[70px] tw-text-xl tw-font-light">
      Place Where Your Stories Meet Others' Emotions.
    </div>
    <div class="tw-flex tw-justify-end tw-mt-6">
    <black-rounded-btn label="Get Started" icon="arrow_right_alt"/>
    </div>

  </div>
</div>
</template>

<style scoped>

</style>
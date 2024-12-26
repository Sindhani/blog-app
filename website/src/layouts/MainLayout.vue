<template>
  <q-layout view="lHh Lpr lFf">
    <the-header></the-header>
    <q-page-container>
      <router-view />
    </q-page-container>
    <q-footer
      class="tw-bg-off-white tw-px-[75px] tw-py-[15px] tw-border tw-t-border"
    >
      <the-footer></the-footer>
    </q-footer>
  </q-layout>
</template>

<script setup>
import TheHeader from "components/ThHeader.vue";
import TheFooter from "components/ThFooter.vue";
</script>

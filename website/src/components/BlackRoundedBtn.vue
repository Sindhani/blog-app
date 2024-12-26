<script setup>
 defineProps({
  label:{
    type:String,
    default:'',
  },
   icon:{
    type:String,
     default:'',
   }
})
</script>

<template>
  <q-btn class="tw-bg-black tw-flex tw-gap-x-4.5 tw-items-center tw-text-white tw-px-[66.5px] tw-py-[16.5px] tw-rounded-[33px] tw-text-xl" no-caps no-wrap>
    <div>{{ label }}</div>
    <template v-if="icon">
      <q-icon :name="icon" class="" color="white"></q-icon>
    </template>
  </q-btn>

</template>

<style scoped>

</style>
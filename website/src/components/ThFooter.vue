<script setup>
const menu = [
    'Our Team',
    'Contact',
    'About',
    'Terms',
    'Help',

]
</script>

<template>
    <q-toolbar flat>
      <q-toolbar-title class="tw-text-black spirax tw-italic tw-text-[40px]">
        Blog App
      </q-toolbar-title>
     <q-space>  </q-space>
      <div class="tw-flex tw-gap-x-[52px] tw-items-center  tw-font-light tw-text-dark-gray tw-justify-center ">
        <div class="tw-text-[20px]" v-for="(item,index) in menu" :key="index">{{ item }}</div>
      </div>
    </q-toolbar>
</template>

<style scoped>

</style>
<script setup>
import copy from "copy-to-clipboard";

defineProps({
    bookmark: Object,
})
</script>
<template>
  <p class="cursor-copy" @click="copy(bookmark.url)">
    <span class="font-bold text-green/60 text-xs">URL as plain text (click and copy to the clipboard):</span> {{ bookmark.url }}
  </p>
</template>

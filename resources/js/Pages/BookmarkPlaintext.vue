<script setup>
import copy from "copy-to-clipboard";

defineProps({
    bookmark: Object,
})
</script>
<template>
  <p class="text-xs cursor-copy" @click="copy(bookmark.url)">
    <span class="font-bold text-purple-300 text">URL as plain text (click and copy to the clipboard):</span> {{ bookmark.url }}
  </p>
</template>

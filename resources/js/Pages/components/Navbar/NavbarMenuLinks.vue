<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link
        class="transition-colors duration-300 p-2 rounded-bl-lg bg-transparent hover:bg-green"> <slot></slot>
    </Link>
</template>

<template>
    <div class="bg-white shadow">
        <slot name="header" />
        <div class="p-4">
            <p class="font-bold text-xs text-gray-800 mb-1">
                {{ news.created_at }}
            </p>
            <p>
                {{ news.message }}
            </p>
        </div>
        <slot name="footer" />
    </div>
</template>

<script>
export default {
    props: {
        news: {
            type: Object,
            require: true,
            default: null
        }
    }
};
</script>

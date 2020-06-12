<template>
    <g-modal-page title="Leave" action-text="OK" @on-click-action="submit">
        <p class="text-gray-800 text-sm">
            If you cancel your membership, your account will be disabled and you
            will not be able to access your contact information or authorized
            company information.<br />
            Once you unsubscribe, you will not be able to get back to your
            account.<br />
            If you wish to cancel your membership, please click the following
            button to complete your cancellation.<br />
        </p>
        <div class="w-20 border-b-4 border-red-500 mx-auto my-4" />
    </g-modal-page>
</template>

<script>
import GModalPage from "@/components/GModalPage.vue";
export default {
    components: {
        GModalPage
    },
    methods: {
        submit() {}
    }
};
</script>

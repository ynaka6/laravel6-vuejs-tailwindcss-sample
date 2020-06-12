<template>
    <div class="bg-white shadow-xl">
        <slot name="header" />
        <div class="p-4">
            <component :is="component" :user="user" />
        </div>
        <slot name="footer" />
    </div>
</template>

<script>
import Dashboard from "./GProfileCard/Dashboard";
import UserDetail from "./GProfileCard/UserDetail";

export default {
    components: {
        Dashboard,
        UserDetail
    },
    props: {
        user: {
            type: Object,
            require: true,
            default: null
        },
        component: {
            type: String,
            require: false,
            default: "Dashboard"
        }
    }
};
</script>

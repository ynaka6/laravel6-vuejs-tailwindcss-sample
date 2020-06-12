<template>
    <div class="lg:flex lg:justify-between">
        <div class="mb-2 lg:mb-0">
            <p class="text-gray-700 text-xs">{{ user.email }}</p>
            <h3 class="text-md mb-1 font-semibold">
                {{ user.profile.name }}
            </h3>
            <p class="text-xs mb-0">
                {{ user.mainEmployee.company.name || "" }}
                {{ user.mainEmployee.department || "" }}
            </p>
        </div>
        <div>
            <t-button
                type="button"
                to="/mypage/profile"
                variant="primary"
                class="rounded-full mr-2"
                size="sm"
            >
                <font-awesome-icon
                    :icon="['fas', 'user-edit']"
                    size="sm"
                    class="mr-1"
                />
                Edit
            </t-button>
            <t-button
                type="button"
                href="/user/preview"
                target="_blank"
                class="rounded-full"
                size="sm"
            >
                <font-awesome-icon
                    :icon="['fas', 'user']"
                    size="sm"
                    class="mr-1"
                />
                Preview
            </t-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            require: true,
            default: null
        }
    }
};
</script>

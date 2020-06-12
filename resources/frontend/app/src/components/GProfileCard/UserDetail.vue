<template>
    <div>
        <div class="mb-2 lg:mb-0">
            <h3 class="font-bold text-2xl mb-1">
                {{ user.profile.name }}
            </h3>
            <div class="border-b-2 border-purple-500 mb-6 opacity-25" />
            <p class="mb-1">
                <font-awesome-icon
                    :icon="['fas', 'business-time']"
                    class="text-purple-800 mr-1"
                />
                <span class="text-gray-800 font-semibold">
                    {{ user.mainEmployee.company.name || "" }}
                    {{ user.mainEmployee.department || "" }}
                    {{ user.mainEmployee.position || "" }}
                </span>
            </p>
            <p v-if="user.mainEmployee.tel" class="mb-4">
                <font-awesome-icon
                    :icon="['fas', 'phone']"
                    class="text-purple-800 mr-1"
                />
                <span class="text-gray-800 font-semibold">
                    {{ user.mainEmployee.tel || "" }}
                </span>
            </p>
            <g-readmore-text
                v-if="user.profile.detail"
                :text="user.profile.detail"
                :height="100"
                open-lable="Read more"
                close-lable="Close"
                class="text-gray-700 text-sm mb-4"
            />
            <div class="flex">
                <div
                    v-for="(data, providor) in user.profile.sites"
                    :key="providor"
                >
                    <t-button
                        v-if="data.url"
                        :href="data.url"
                        target="_blank"
                        class="h-12 w-12 rounded-full mr-2"
                    >
                        <font-awesome-icon
                            :icon="data.icon"
                            size="lg"
                            :class="providor"
                        />
                    </t-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import GReadmoreText from "@/elements/GReadmoreText";

export default {
    components: {
        GReadmoreText
    },
    props: {
        user: {
            type: Object,
            require: true,
            default: null
        }
    }
};
</script>

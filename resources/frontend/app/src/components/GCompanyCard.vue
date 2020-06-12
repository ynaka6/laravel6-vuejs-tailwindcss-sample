<template>
    <div class="p-6 bg-white border shadow">
        <div class="lg:flex lg:justify-between">
            <div class="mb-2 lg:mb-0">
                <h4 class="text-md mb-4 font-semibold">{{ company.name }}</h4>
                <ul>
                    <li>
                        <router-link to="/" class="text-xs hover:underline">
                            <font-awesome-icon
                                :icon="['fas', 'caret-square-right']"
                                class="text-purple-800 mr-1"
                            />
                            Company Dashboard
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/" class="text-xs hover:underline">
                            <font-awesome-icon
                                :icon="['fas', 'caret-square-right']"
                                class="text-purple-800 mr-1"
                            />
                            Edit Company Profile
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        company: {
            type: Object,
            require: true,
            default: null
        }
    }
};
</script>

<template>
    <div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-white border rounded shadow p-2">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-green-600">
                                <font-awesome-icon
                                    :icon="['fas', 'building']"
                                    class="text-white"
                                    size="lg"
                                />
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-500">
                                企業数
                            </h5>
                            <h3 class="font-bold text-3xl">
                                0
                            </h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-white border rounded shadow p-2">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-yellow-600">
                                <font-awesome-icon
                                    :icon="['fas', 'users']"
                                    class="text-white"
                                    size="lg"
                                />
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-500">
                                アカウント数
                            </h5>
                            <h3 class="font-bold text-3xl">
                                0
                            </h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-white border rounded shadow p-2">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-yellow-600">
                                <font-awesome-icon
                                    :icon="['fas', 'user-plus']"
                                    class="text-white"
                                    size="lg"
                                />
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-500">
                                新規アカウント
                            </h5>
                            <h3 class="font-bold text-3xl">
                                0
                            </h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "home"
};
</script>

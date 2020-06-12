<template>
    <div class="container">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Home' },
                { to: '/mypage', name: 'MyPage' },
                { to: null, name: 'Activity' }
            ]"
        />
        <g-page-title title="Activity" icon="database" class="w-full mb-4" />
        <t-table
            table-class="w-full overflow-x-scroll whitespace-no-wrap block shadow-xl sm:table"
            :thead-class="{
                thead: 'bg-orange-200',
                tr: 'border',
                th: 'text-left text-sm font-bold p-3 text-gray-900'
            }"
            :headers="['Datetime', 'Detail']"
            :data="list"
        >
            <template v-slot:row="props">
                <tr :class="[props.trClass, `text-xs bg-white`]">
                    <td :class="props.tdClass" style="width: 100px;">
                        {{ props.row.datetime }}
                    </td>
                    <td :class="[props.tdClass, `min-w-full`]">
                        <a
                            v-if="props.row.path"
                            :href="props.row.path"
                            class=""
                            target="_blank"
                            size="sm"
                        >
                            {{ props.row.message }}
                            <sup>
                                <font-awesome-icon
                                    :icon="['fas', 'external-link-alt']"
                                    size="sm"
                                    class="text-purple-500"
                                />
                            </sup>
                        </a>
                        <span v-else v-text="props.row.message" />
                    </td>
                </tr>
            </template>
            <template
                v-if="pagination"
                v-slot:tfoot="{
                    tfootClass,
                    trClass,
                    tdClass,
                    renderResponsive
                }"
            >
                <tfoot :class="tfootClass">
                    <tr :class="trClass">
                        <td :class="tdClass" :colspan="2">
                            <t-pagination
                                v-model="page"
                                :hide-prev-next-controls="renderResponsive"
                                :total-items="pagination.total"
                                :per-page="pagination.perPage"
                                :class="{
                                    'ml-auto': !renderResponsive,
                                    'mx-auto': renderResponsive
                                }"
                            />
                        </td>
                    </tr>
                </tfoot>
            </template>
        </t-table>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import GPageTitle from "@/components/GPageTitle";
import GBreadcrumb from "@/components/GBreadcrumb";
import { fetchMyActivities } from "@/core/api/myApi.js";

export default {
    components: {
        GPageTitle,
        GBreadcrumb
    },
    data() {
        return {
            list: [],
            page: 1,
            pagination: null
        };
    },
    created() {
        this.fetch();
    },
    computed: {
        ...mapGetters({
            user: "auth/user"
        })
    },
    watch: {
        page: function(newPage, oldPage) {
            if (newPage != oldPage) {
                this.fetch(newPage);
            }
        }
    },
    methods: {
        fetch(page) {
            const params = {};
            if (page) {
                params["page"] = page;
            }
            this.fetchMyActivities(params).then(response => {
                const responseData = response.data || null;
                if (responseData) {
                    this.list = responseData.data;
                    this.pagination = responseData.pagination;
                    this.page = this.pagination.currentPage;
                }
            });
        },
        fetchMyActivities
    }
};
</script>

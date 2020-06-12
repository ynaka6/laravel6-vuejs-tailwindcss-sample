<template>
    <div>
        <div class="flex flex-wrap">
            <breadcrumb
                :breadcrumbs="[
                    { to: '/', name: 'ダッシュボード' },
                    { to: null, name: '管理ユーザー一覧' }
                ]"
            />
            <div class="w-full relative">
                <page-title
                    title="管理ユーザー一覧"
                    icon="users"
                    class="w-full mb-4"
                />
                <div class="absolute top-0 right-0 -mt-5 mr-5">
                    <router-link
                        to="/staff/create"
                        class="rounded-full h-8 w-8 flex items-center justify-center t-button border block rounded inline-flex items-center justify-center px-6 py-6 text-white bg-teal-500 border-teal-500 hover:bg-teal-600 hover:border-teal-600"
                    >
                        <span>
                            <font-awesome-icon
                                :icon="['fas', 'plus']"
                                size="lg"
                            />
                        </span>
                    </router-link>
                </div>
            </div>
            <t-card class="w-full mb-4">
                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/3 lg:px-2">
                        <t-input-group label="名前">
                            <t-input
                                type="text"
                                label="名前"
                                autofocus
                                autocapitalize="off"
                                v-model="form.name"
                                @change="fetch(1)"
                            />
                        </t-input-group>
                    </div>
                    <div class="w-full lg:w-1/3 lg:px-2">
                        <t-input-group label="メールアドレス">
                            <t-input
                                type="text"
                                label="メールアドレス"
                                autofocus
                                v-model="form.email"
                                @change="fetch(1)"
                            />
                        </t-input-group>
                    </div>
                    <div class="w-full lg:w-1/3 lg:px-2">
                        <t-input-group label="権限">
                            <t-select
                                name="role"
                                :options="adminRoleOption"
                                v-model="form.role"
                                @change="fetch(1)"
                            />
                        </t-input-group>
                    </div>
                </div>
            </t-card>
            <t-table
                :headers="['ID', '名称', 'メールアドレス', '権限', '']"
                :data="list"
                :responsive="true"
                :responsive-breakpoint="1024"
                :tbody-class="{
                    tbody: 'border-t lg:border-0',
                    tr: 'border-0 lg:border-t',
                    td: 'p-3'
                }"
            >
                <template
                    v-slot:tbody="{
                        tbodyClass,
                        trClass,
                        tdClass,
                        thClass,
                        renderResponsive,
                        data
                    }"
                >
                    <template v-if="renderResponsive">
                        <tbody
                            v-for="(row, rowIndex) in data"
                            :key="rowIndex"
                            :class="[
                                tbodyClass,
                                rowIndex % 2 === 0 ? 'bg-gray-100' : ''
                            ]"
                        >
                            <tr :class="trClass">
                                <th :class="thClass">ID</th>
                                <td :class="[tdClass, 'relative']">
                                    <t-dropdown
                                        :visible-arrow="false"
                                        placement="left-start"
                                        variant="tertiary"
                                        class="absolute right-0 top-0"
                                    >
                                        <template v-slot:button-content>
                                            <font-awesome-icon
                                                :icon="['fas', 'ellipsis-h']"
                                                class="text-gray-800"
                                                size="lg"
                                            />
                                        </template>
                                        <router-link
                                            :to="`/staff/${row.id}/edit`"
                                            class="block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left"
                                        >
                                            編集
                                        </router-link>
                                        <button
                                            v-if="
                                                0 !== parseInt(row.role.value)
                                            "
                                            class="block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left"
                                            @click.prevent="
                                                onClickDelete(row.id)
                                            "
                                        >
                                            削除
                                        </button>
                                    </t-dropdown>
                                    {{ row.id }}
                                </td>
                            </tr>
                            <tr :class="trClass">
                                <th :class="thClass">名称</th>
                                <td :class="[tdClass, 'relative']">
                                    {{ row.name }}
                                </td>
                            </tr>
                            <tr :class="trClass">
                                <th :class="thClass">メールアドレス</th>
                                <td :class="[tdClass, 'td-overflow']">
                                    <a
                                        :href="`mailto: ${row.email}`"
                                        class="text-gray-600 hover:underline"
                                        >{{ row.email }}</a
                                    >
                                </td>
                            </tr>
                            <tr :class="trClass">
                                <th :class="thClass">権限</th>
                                <td :class="[tdClass]">
                                    <span
                                        class="d-flex py-2 px-5 text-sm rounded-full font-bold"
                                        :class="[
                                            `bg-${row.role.color}-200 text-${row.role.color}-900`
                                        ]"
                                    >
                                        {{ row.role.description }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </template>
                <template v-slot:row="{ trClass, tdClass, rowIndex, row }">
                    <tr
                        :class="[
                            trClass,
                            rowIndex % 2 === 0 ? 'bg-gray-100' : ''
                        ]"
                    >
                        <td :class="[tdClass]">
                            {{ row.id }}
                        </td>
                        <td :class="[tdClass]">
                            {{ row.name }}
                        </td>
                        <td :class="tdClass">
                            <a
                                :href="`mailto: ${row.email}`"
                                class="text-gray-600 hover:underline"
                                >{{ row.email }}</a
                            >
                        </td>
                        <td :class="[tdClass, 'text-center']">
                            <span
                                class="d-flex py-2 px-5 text-sm rounded-full font-bold"
                                :class="[
                                    `bg-${row.role.color}-200 text-${row.role.color}-900`
                                ]"
                            >
                                {{ row.role.description }}
                            </span>
                        </td>
                        <td :class="[tdClass, 'text-right']">
                            <t-dropdown
                                :visible-arrow="false"
                                placement="bottom-end"
                                variant="tertiary"
                            >
                                <template v-slot:button-content>
                                    <font-awesome-icon
                                        :icon="['fas', 'ellipsis-h']"
                                        size="lg"
                                        class="text-gray-800"
                                    />
                                </template>
                                <router-link
                                    :to="`/staff/${row.id}/edit`"
                                    class="block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left"
                                >
                                    編集
                                </router-link>
                                <button
                                    v-if="0 !== parseInt(row.role.value)"
                                    class="block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left"
                                    @click.prevent="onClickDelete(row.id)"
                                >
                                    削除
                                </button>
                            </t-dropdown>
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
                            <td
                                :class="tdClass"
                                :colspan="renderResponsive ? 2 : 4"
                            >
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
        <confirm-modal ref="confirmModal" v-bind.sync="confirmModel" />
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import http from "@/http";
import PageTitle from "@/components/PageTitle";
import Breadcrumb from "@/components/Breadcrumb";
import ConfirmModal from "@/components/ConfirmModal";

export default {
    components: {
        PageTitle,
        Breadcrumb,
        ConfirmModal
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                role: null
            },
            list: [],
            page: 1,
            pagination: null,
            confirmModel: {
                title: "管理ユーザー削除",
                message: "",
                okText: "削除する"
            }
        };
    },
    created: function() {
        this.fetch();
    },
    computed: {
        ...mapGetters({
            adminRoleOption: "config/adminRoleOption"
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
            const params = this.form;
            if (page) {
                params["page"] = page;
            }
            this.showOverlayLoading();
            http.get("/api/staffs", { params }).then(response => {
                const responseData = response.data || null;
                if (responseData) {
                    this.list = responseData.data;
                    this.pagination = responseData.pagination;
                    this.page = this.pagination.currentPage;
                }
                this.hideOverlayLoading();
            });
        },
        onClickDelete(id) {
            this.confirmModel.message = `ID: ${id}のユーザーを削除しますか？`;
            this.confirmModel.okFunction = () => {
                this.showOverlayLoading();
                http.delete(`/api/staff/${id}`).then(() => {
                    this.fetch(1);
                });
            };
            this.$refs.confirmModal.show();
        },
        ...mapActions({
            showOverlayLoading: "showOverlayLoading",
            hideOverlayLoading: "hideOverlayLoading"
        })
    }
};
</script>

<template>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 lg:px-2">
            <t-input-group
                label="名前"
                :status="formState('name').status"
                :feedback="formState('name').message"
            >
                <t-input
                    type="text"
                    label="名前"
                    autofocus
                    autocapitalize="off"
                    :value="name"
                    @input="$emit('update:name', $event)"
                />
            </t-input-group>
        </div>
        <div class="w-full lg:w-1/2 lg:px-2">
            <t-input-group
                label="メールアドレス"
                :status="formState('email').status"
                :feedback="formState('email').message"
            >
                <t-input
                    type="email"
                    label="メールアドレス"
                    :value="email"
                    @input="$emit('update:email', $event)"
                />
            </t-input-group>
        </div>
        <div class="w-full lg:w-1/2 lg:px-2">
            <t-input-group
                label="パスワード"
                :status="formState('password').status"
                :feedback="formState('password').message"
            >
                <t-input
                    type="password"
                    label="パスワード"
                    :value="password"
                    @input="$emit('update:password', $event)"
                />
            </t-input-group>
        </div>
        <div class="w-full lg:w-1/2 lg:px-2">
            <t-input-group
                label="権限"
                :status="formState('role').status"
                :feedback="formState('role').message"
            >
                <t-select
                    name="role"
                    :options="
                        constant && constant.adminRoles
                            ? constant.adminRoles.map((k, v) => ({
                                  text: k,
                                  value: v
                              }))
                            : []
                    "
                    :value="role"
                    @change="$emit('update:role', $event)"
                />
            </t-input-group>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    props: {
        name: {
            type: String,
            required: false,
            default: null
        },
        email: {
            type: String,
            required: false,
            default: null
        },
        password: {
            type: String,
            required: false,
            default: null
        },
        role: {
            type: Number,
            required: false,
            default: 1
        }
    },
    computed: {
        ...mapGetters({
            constant: "config/const"
        })
    },
    methods: {
        formState(name) {
            return this.errors &&
                this.errors[name] &&
                0 < this.errors[name].length
                ? { status: "error", message: this.errors[name][0] }
                : { status: null, message: null };
        }
    }
};
</script>

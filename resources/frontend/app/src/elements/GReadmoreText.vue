<template>
    <div>
        <p
            ref="text"
            class="whitespace-pre-line overflow-y-hidden"
            :style="style"
        >
            {{ text }}
        </p>
        <a
            v-if="isToggle"
            href="#"
            class="block text-blue-500 mt-1"
            @click.prevent="toggle"
        >
            {{ linkLabel }}
        </a>
    </div>
</template>

<script>
export default {
    props: {
        text: {
            type: String,
            require: true,
            default: null
        },
        height: {
            type: Number,
            require: false,
            default: null
        },
        openLable: {
            type: String,
            require: true,
            default: "Read More"
        },
        closeLable: {
            type: String,
            require: true,
            default: "Close"
        }
    },
    data() {
        return {
            style: {
                height: `auto`
            },
            isToggle: false,
            open: false,
            linkLabel: this.openLable
        };
    },
    mounted() {
        if (this.height && this.$refs.text.clientHeight > this.height) {
            this.$refs.text.style.height = `${this.height}px`;
            this.isToggle = true;
        } else {
            this.$refs.text.style.height = `auto`;
        }
    },
    methods: {
        toggle() {
            this.open = !this.open;
            this.$refs.text.style.height = this.open
                ? `auto`
                : `${this.height}px`;
            this.linkLabel = this.open ? this.closeLable : this.openLable;
        }
    }
};
</script>

<style lang="postcss" scoped></style>

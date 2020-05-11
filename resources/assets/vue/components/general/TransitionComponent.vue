<template>
    <component :is="type"
               :tag="tag"
               :enter-active-class="enterClass"
               :leave-active-class="leaveClass"
               v-on="hooks">
        <slot></slot>
    </component>
</template>
<script>
    export default {
        props: {
            speed: {
                type: String,
                default: 'normal'
            },
            enterClass: {
                type: String,
                default: 'slide-in-right'
            },
            leaveClass: {
                type: String,
                default: 'slide-out-right'
            },
            group: {
                type: Boolean,
                default: false
            },
            tag: {
                type: String,
                default: "div"
            }
        },
        computed: {
            type() {
                return this.group ? "transition-group" : "transition";
            },
            hooks() {
                return {
                    beforeEnter: this.setAbsolutePosition,
                    afterEnter: this.cleanUp,
                    beforeLeave: this.setAbsolutePosition,
                    afterLeave: this.cleanUp
                };
            }
        },
        methods: {
            setAbsolutePosition(el){
                el.style.width = "calc(100% + 30px)";
                el.style.position = "absolute";
            },
            cleanUp(el) {
                el.style.width = "";
                el.style.position = "";
            }
        }
    };
</script>
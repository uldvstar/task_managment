<template>
    <div class="modal modalContainer" :data-type="this.type">
        <div class="modal-dialog"  v-bind:class="[{'modal-lg': this.large}, {'modal-sm': this.small}]">
            <div class="modal-content">
                <div class="modal-body">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            'type': {
                type: String,
                required: true
            },
            'large': {
                type: Boolean,
                default: false
            },
            'small': {
                type: Boolean,
                default: false
            },
            'effect': {
                type: String,
                default: "stick-up"
            }
        }
    }
</script>

<template>
    <modal-component class="animated fast" :class="[{'modal-right': !data}, {'fadeInRight': !data} , {'fadeInDownBig': data}]" :type="data ? 'editModal' : 'createModal'">
        <transition-component group enter-class="animated fadeInDown faster" leave-class="animated fadeOutUp faster">
            <loading-component style="height: 300px; top: 0;" key="1" color="success" v-show="$store.getters.isLoading(section+'.form')" ></loading-component>
            <div class="row" key="2" v-show="!$store.getters.isLoading(section+'.form')">
                <div class="col">
                    <slot name="form" :section="section" :data="data"></slot>
                </div>
            </div>
        </transition-component>
    </modal-component>
</template>
<script>
    export default {
        props: {
            section: {
                type: String,
                required: true
            },
            data: {
                type: Object,
                default: null
            }
        }

    }
</script>

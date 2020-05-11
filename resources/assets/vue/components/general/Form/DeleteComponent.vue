<template>
    <modal-component class="animated fast fadeInDownBig" small type="deleteModal">
        <transition-component group enter-class="animated fadeInDown faster" leave-class="animated fadeOutUp faster">
            <loading-component style="height: 100px; top: 0;" key="1" color="success" v-show="$store.getters.isLoading(section+'.delete')" ></loading-component>
            <div class="row" key="2" v-show="!$store.getters.isLoading(section+'.delete')">
                <div class="col">
                    <div class="row mb-3">
                        <div class="col">
                            <p>Are you sure you want to delete this {{ name }}?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="btn btn-outline-dark mr-2" @click="closeModal()" >Cancel</button>
                            <button type="button" class="btn btn-outline-danger" @click="submit(requestRoute, 'delete', section+'.delete', true, true)">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition-component>
    </modal-component>

</template>
<script>
    export default {
        props: {
            'section': {
                type: String,
                required: true
            },
            'name': {
                type: String,
                default: 'element'
            },
            'requestRoute': {
                type: String,
                required: true
            }
        },
        methods: {
            successHandler(){
                this.updateList();
                this.closeModal();
            },
            closeModal(){
                $(this.$el).modal('hide');
            }
        }
    }
</script>

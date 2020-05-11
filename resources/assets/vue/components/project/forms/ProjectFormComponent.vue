<template>
    <div class="row" v-on:keyup.enter="submitForm()">
        <div class="col">
            <div class="row mb-3">
                <div class="col">
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.type_id">
                                <selectable-component  :endpoint="route('api.modular_type.list', 'project')" section="projectTypeSection" valueColumn="id" labelColumn="name" v-model="parameters.type_id"></selectable-component>
                                <span>service type</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.client_id">
                                <selectable-component  :endpoint="route('api.client.list')" section="clientSection" valueColumn="id" labelColumn="name" v-model="parameters.client_id"></selectable-component>
                                <span>customer</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.reference">
                                <input v-model="parameters.reference" type="text" class="form-control">
                                <span>reference</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.description">
                                <textarea v-model="parameters.description" class="form-control"></textarea>
                                <span>description</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.status">
                                <selectable-component  :endpoint="route('api.modular_type.list', 'status')" section="statusTypeSection" valueColumn="id" labelColumn="name" v-model="parameters.status"></selectable-component>
                                <span>status</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="btn btn-outline-dark float-left" @click="closeModal()">Cancel</button>
                            <button type="button" class="btn btn-primary" @click="submitForm()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { required, email } from "vuelidate/lib/validators";
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
        },
        created() {
            if(this.data){
                this.parameters = this.data;
            }

        },
        data() {
            return {
                parameters: {
                    type_id: '',
                    client_id: '',
                    reference: '',
                    description: '',
                    status: ''
                },
            };
        },
        validations: {
            parameters: {
                type_id: { required },
                client_id: { required },
                reference: { required },
                description: {  },
                status: { required }
            }
        },

        methods:{
            submitForm(){
                this.submit((this.data ? this.route('api.project.update', this.data.id) : this.route('api.project.create')), (this.data ? 'put' : 'post'), this.section+'.form', true, true)
            },
            successHandler(){
                this.crudSuccess();
            }
        }
    }
</script>

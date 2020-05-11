<template>
    <div class="row" v-on:keyup.enter="submitForm()">
        <div class="col">
            <div class="row mb-3">
                <div class="col">
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.type_id">
                                <selectable-component  :endpoint="route('api.modular_type.list', 'client')" section="clientTypeSection" valueColumn="id" labelColumn="name" v-model="parameters.type_id"></selectable-component>
                                <span>customer group</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.marking">
                                <input v-model="parameters.marking" type="text" class="form-control">
                                <span>marking</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.name">
                                <input v-model="parameters.name" type="text" class="form-control">
                                <span>name</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.email">
                                <input v-model="parameters.email" type="email" class="form-control">
                                <span>email</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.wechat_id">
                                <input v-model="parameters.wechat_id" type="text" class="form-control">
                                <span>wechat_id</span>
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
                    marking: '',
                    name: '',
                    email: '',
                    wechat_id: ''
                },
            };
        },
        validations: {
            parameters: {
                type_id: { required },
                marking: { required },
                name: { required },
                email: { required, email },
                wechat_id: {  }
            }
        },

        methods:{
            submitForm(){
                this.submit((this.data ? this.route('api.client.update', this.data.id) : this.route('api.client.create')), (this.data ? 'put' : 'post'), this.section+'.form', true, true)
            },
            successHandler(){
                this.crudSuccess();
            }
        }
    }
</script>

<template>
    <div class="row" v-on:keyup.enter="submitForm()">
        <div class="col">
            <div class="row mb-3">
                <div class="col">
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
                            <validation-wrapper-component :validator="$v.parameters.description">
                                <textarea v-model="parameters.description" class="form-control"></textarea>
                                <span>description</span>
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
            },
            type: {
                type: String
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
                    name: '',
                    description: ''
                },
            };
        },
        validations: {
            parameters: {
                name: { required },
                description: {  }
            }
        },

        methods:{
            submitForm(){
                this.submit((this.data ? this.route('api.modular_type.update', this.data.id) : this.route('api.modular_type.create', this.type)), (this.data ? 'put' : 'post'), this.section+'.form', true, true)
            },
            successHandler(){
                this.crudSuccess();
            }
        }
    }
</script>

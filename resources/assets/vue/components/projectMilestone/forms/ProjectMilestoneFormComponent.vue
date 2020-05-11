<template>
    <div class="row" v-on:keyup.enter="submitForm()">
        <div class="col">
            <div class="row mb-3">
                <div class="col">
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.project_id">
                                <selectable-component  :endpoint="route('api.project.list')" section="projectSection" valueColumn="id" labelColumn="name" v-model="parameters.project_id"></selectable-component>
                                <span>project</span>
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
                    project_id: '',
                    name: ''
                },
            };
        },
        validations: {
            parameters: {
                project_id: { required },
                name: { required }
            }
        },

        methods:{
            submitForm(){
                this.submit((this.data ? this.route('api.project_milestone.update', this.data.id) : this.route('api.project_milestone.create')), (this.data ? 'put' : 'post'), this.section+'.form', true, true)
            },
            successHandler(){
                this.crudSuccess();
            }
        }
    }
</script>

<template>
    <div class="row" v-on:keyup.enter="submitForm()">
        <div class="col">
            <div class="row mb-3">
                <div class="col">
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.milestone_id">
                                <selectable-component  :endpoint="route('api.project_milestone.list')" section="projectMilestoneSection" valueColumn="id" labelColumn="name" v-model="parameters.milestone_id"></selectable-component>
                                <span>milestone</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.type_id">
                                <selectable-component  :endpoint="route('api.modular_type.list')" section="modularTypeSection" valueColumn="id" labelColumn="name" v-model="parameters.type_id"></selectable-component>
                                <span>type</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.title">
                                <input v-model="parameters.title" type="text" class="form-control">
                                <span>title</span>
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
                                <selectable-component  :endpoint="route('api.modular_type.list')" section="modularTypeSection" valueColumn="id" labelColumn="name" v-model="parameters.status"></selectable-component>
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
                    milestone_id: '',
                    type_id: '',
                    title: '',
                    description: '',
                    status: ''
                },
            };
        },
        validations: {
            parameters: {
                milestone_id: {  },
                type_id: { required },
                title: { required },
                description: {  },
                status: { required }
            }
        },

        methods:{
            submitForm(){
                this.submit((this.data ? this.route('api.task.update', this.data.id) : this.route('api.task.create')), (this.data ? 'put' : 'post'), this.section+'.form', true, true)
            },
            successHandler(){
                this.crudSuccess();
            }
        }
    }
</script>

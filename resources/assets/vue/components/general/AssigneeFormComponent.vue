<template>
    <div>
        <selectable-component v-if="parameters.assignee_type === 'Department'" v-on:change="submitForm()"  :endpoint="route('api.department.list')" section="departmentSection" valueColumn="id" labelColumn="name" v-model="parameters.assignee_id"></selectable-component>
        <selectable-component v-if="parameters.assignee_type === 'User'" v-on:change="submitForm()"  :endpoint="route('api.account.user.list')" section="userSection" valueColumn="id" labelColumn="name" v-model="parameters.assignee_id"></selectable-component>
    </div>
</template>
<script>
    import { required, email } from "vuelidate/lib/validators";
    export default {
        props: {
            assignable: {
                type: Object,
                default: null
            }
        },
        watch: {
            'parameters.assignee_id': function() {
                this.submitForm();
            }
        },
        data() {
            return {
                parameters: {
                    assignee_id: '',
                    assignee_type: this.assignable.assignee_type,
                    assignment_id: this.assignable.assignment_id,
                    assignment_type: this.assignable.assignment_type
                },
            };
        },
        validations: {
            parameters: {
                assignee_id: { required },
                assignee_type: { required },
                assignment_id: { required },
                assignment_type: { required }
            }
        },

        methods:{
            submitForm(){
                this.submit(this.route('api.assignee.create'), 'post', null, true, true)
            },
            successHandler(){

            }
        }
    }
</script>

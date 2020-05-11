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
            section: {
               type: String,
               required: true
            },
            data: {
                type: Object,
                default: null
            },
            assignable: {
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
                    assignee_id: '',
                    assignee_type: this.assignable.assignee_type,
                    assignment_id: this.assignable.assignment_id,
                },
            };
        },
        validations: {
            parameters: {
                assignee_id: { required },
                assignee_type: { required },
                assignment_id: { required }
            }
        },
        watch: {
            'parameters.assignee_id': function() {
                this.submitForm();
            }
        },
        methods:{
            submitForm(){
                this.submit(this.route('api.milestone_task_assignee.create'),'post', null, true, true)
            },
            successHandler(){
                this.updateList()
            }
        }
    }
</script>

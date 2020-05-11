<template>
    <div class="row" style="margin-top: -8px;">
        <div class="col">
            <div class="mr-2 mb-1 d-inline-block text-center assignee-avatar"  v-for="assignee in assignees">
                <avatar :size="30" :username="assignee.name"></avatar>
                <i class="iconsminds-close d-block mt-1 delete-icon pointer text-danger" @click="deleteAssignee(assignee.id)"></i>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            section: {
                type: String,
                required: true
            },
            data: {
                type: Array,
                required: true
            },
            assignable: {
                type: Object,
                default: null
            }
        },
        watch: {
            'data': function() {
                this.assignees = this.data;
            }
        },
        data() {
            return {
                assignees: this.data,
                parameters: {
                    assignee_id: '',
                    assignee_type: this.assignable.assignee_type,
                    assignment_id: this.assignable.assignment_id,
                },
            };
        },
        methods:{
            deleteAssignee(id){
                this.parameters.assignee_id = id;
                this.submit(this.route('api.milestone_task_assignee.delete'), 'delete', null, true, true)
            },
            successHandler(){
                this.updateList()
            }
        }
    }
</script>
<style>
    .delete-icon {
        visibility: hidden;
    }
    .assignee-avatar:hover .delete-icon {
        visibility: visible;
    }
</style>

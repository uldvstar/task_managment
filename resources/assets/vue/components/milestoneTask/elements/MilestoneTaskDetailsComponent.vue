<template>
    <div class="modal modalContainer" data-type="taskDetails">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-4 pr-4 pt-3 pb-3 bg-primary">
                    <div class="row w-100">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h5 class="modal-title">{{milestoneTask.title}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>{{milestoneTask.business_service.name}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto p-0">
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="row m-0">
                        <div class="col p-4">
                            <div class="row">
                                <div class="col">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <small>Description</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p>{{milestoneTask.description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 bg-dark p-4">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <small class="text-uppercase"><i class="simple-icon-vector mr-2"></i>Departments</small>
                                                </div>
                                            </div>
                                            <div class="row assign-list">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <small class="toggleAssignList mt-2 d-block pointer">Assign task to department <i class="iconsminds-arrow-down float-right"></i></small>
                                                            <milestone-task-assignee-form-component section="milestoneSection" :assignable="{assignment_id: milestoneTask.id, assignee_type: 'Department'}"></milestone-task-assignee-form-component>
                                                            <small class="text-warning d-block" style="margin-top: -8px;" v-if="!milestoneTask.assignees.departments.length">No department assigned for this task</small>
                                                            <assignee-component section="milestoneSection"  v-if="milestoneTask.assignees.departments.length" :data="milestoneTask.assignees.departments" :assignable="{assignment_id: milestoneTask.id, assignee_type: 'Department'}"></assignee-component>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <small class="text-uppercase"><i class="iconsminds-profile mr-2"></i>Employees</small>
                                                </div>
                                            </div>
                                            <div class="row assign-list">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <small class="toggleAssignList mt-2 d-block pointer">Assign task to employee <i class="iconsminds-arrow-down float-right"></i></small>
                                                            <milestone-task-assignee-form-component section="milestoneSection" :assignable="{assignment_id: milestoneTask.id, assignee_type: 'User'}"></milestone-task-assignee-form-component>
                                                            <small class="text-warning d-block" style="margin-top: -8px;" v-if="!milestoneTask.assignees.users.length">No department assigned for this task</small>
                                                            <assignee-component section="milestoneSection"  v-if="milestoneTask.assignees.users.length" :data="milestoneTask.assignees.users" :assignable="{assignment_id: milestoneTask.id, assignee_type: 'User'}"></assignee-component>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            data: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                milestoneTask: this.data,
                department: ''
            }
        },
        watch: {
          'data': function() {
              this.milestoneTask = this.data;
          }
        }
    }
</script>

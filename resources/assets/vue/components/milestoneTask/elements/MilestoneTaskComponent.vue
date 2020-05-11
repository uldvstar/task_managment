<template>
    <div class="mb-2 parentContainer">
        <div class="row">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">Task Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{milestoneTask.task_type.name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">title</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{milestoneTask.title}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-outline-info icon-button mr-1 requestModal" data-type="taskDetails"><i class="iconsminds-wrench"></i></button>
                        <button type="button" class="btn btn-outline-secondary icon-button mr-1 requestModal" data-type="editModal"><i class="iconsminds-pen-2"></i></button>
                        <button type="button" class="btn btn-outline-danger icon-button requestModal" data-type="deleteModal"><i class="simple-icon-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <milestone-task-details-component :data="data"></milestone-task-details-component>
        <form-component section="milestoneSection" :data="milestoneTask">
            <template slot="form" slot-scope="{section, data}">
                <milestone-task-form-component :section="section" :data="data"></milestone-task-form-component>
            </template>
        </form-component>
        <delete-component section="milestoneSection" :requestRoute="route('api.milestone_task.delete', milestoneTask.id)" name="task"></delete-component>
    </div>
</template>
<script>
    import MilestoneTaskDetailsComponent from "./MilestoneTaskDetailsComponent";
    export default {
        components: {MilestoneTaskDetailsComponent},
        props: {
            data: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                milestoneTask: this.data,
            }
        },
        watch: {
          'data': function() {
              this.milestoneTask = this.data;
          }
        }
    }
</script>

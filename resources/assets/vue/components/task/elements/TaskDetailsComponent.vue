<template>
    <div class="modal modalContainer" data-type="taskDetails">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-4 pr-4 pt-3 pb-3 bg-primary">
                    <div class="row w-100">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h5 class="modal-title">{{task.title}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>{{task.business_service.name}}</small>
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
                            <div class="row mb-5"  v-if="task.status !== '12'">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-success default mr-1" @click="startTimer()" v-if="!task.user_active_tracker"><i class="iconsminds-stopwatch"></i> Start Timer</button>
                                    <button type="button" class="btn btn-sm btn-danger default mr-1" @click="stopTimer()" data-type="taskDetails"  v-if="task.user_active_tracker"><i class="iconsminds-stopwatch"></i> Stop Timer</button>
                                    <button type="button" class="btn btn-sm btn-primary default mr-1" @click="completeTask()" v-if="task.user_active_tracker"><i class="iconsminds-yes"></i> Task Completed</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row m-0 pt-3 pb-3" style="background-color: #1e1e1e !important;">
                                        <div class="col">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <small class="text-uppercase text-warning">Description</small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <p class="m-0">{{task.description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <div class="row mb-5">
                                        <div class="col">
                                            <comment-form-component section="taskSection" :commentable="{commentable_id: task.id, commentable_type: 'Task'}"></comment-form-component>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row mb-4" v-for="comment in task.comments">
                                                <div class="col">
                                                    <div class="border-bottom pb-3">
                                                        <div class="row">
                                                            <div class="col-auto pr-0">
                                                                <avatar :size="30" :username="comment.user.name"></avatar>
                                                            </div>
                                                            <div class="col">
                                                                <p class="font-weight-medium mb-1">{{comment.user.name}}</p>
                                                                <p class="text-semi-muted text-small mb-1">{{comment.comment}}</p>
                                                                <p class="text-muted mb-0 text-small">{{comment.created_at}}</p>
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
                        <div class="col-4 bg-dark p-4">
                            <div class="row">
                                <div class="col">
                                    <div class="row mb-5">
                                        <div class="col">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <h6 class="text-uppercase">Task Info</h6>
                                                </div>
                                            </div>
                                            <div class="row" style="font-size: 12px;">
                                                <div class="col">
                                                    <div class="row mb-2 pb-1 border-bottom">
                                                        <div class="col">
                                                            <small class="text-uppercase">Reference</small>
                                                        </div>
                                                        <div class="col-auto">
                                                            <small>{{task.milestone.project.reference}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2 pb-1 border-bottom">
                                                        <div class="col">
                                                            <small class="text-uppercase">Marking</small>
                                                        </div>
                                                        <div class="col-auto">
                                                            <small>{{task.milestone.project.client.marking}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2 pb-1 border-bottom">
                                                        <div class="col">
                                                            <small class="text-uppercase">Milestone</small>
                                                        </div>
                                                        <div class="col-auto">
                                                            <small class="text-info">{{task.milestone.name}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2 pb-1 border-bottom">
                                                        <div class="col">
                                                            <small class="text-uppercase">logged time</small>
                                                        </div>
                                                        <div class="col-auto">
                                                            <small class="text-success">{{task.total_time}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                            <small class="text-warning d-block" v-if="!task.assignees.departments.length">No department assigned for this task</small>
                                                            <div class="row mt-3" v-if="task.assignees.departments.length">
                                                                <div class="col">
                                                                    <div class="mr-2 mb-1 d-inline-block text-center assignee-avatar"  v-for="assignee in task.assignees.departments">
                                                                        <avatar :size="30" :username="assignee.name"></avatar>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                            <small class="text-warning d-block" v-if="!task.assignees.users.length">No department assigned for this task</small>
                                                            <div class="row mt-3" v-if="task.assignees.users.length">
                                                                <div class="col">
                                                                    <div class="mr-2 mb-1 d-inline-block text-center assignee-avatar"  v-for="assignee in task.assignees.users">
                                                                        <avatar :size="30" :username="assignee.name"></avatar>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                    <small class="text-uppercase"><i class="iconsminds-24-hour mr-2"></i>Time Log</small>
                                                </div>
                                            </div>
                                            <div class="row assign-list">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <small class="text-warning d-block" v-if="!task.time_tracker.length">No one has worked on this task yet</small>
                                                            <div class="row mt-3" v-if="task.time_tracker.length">
                                                                <div class="col">
                                                                    <div class="row mb-2 align-items-center"  v-for="tracker in task.time_tracker">
                                                                        <div class="col-auto pr-0">
                                                                            <avatar :size="20" :username="tracker.user.name"></avatar>
                                                                        </div>
                                                                        <div class="col-auto">{{tracker.total_time}}</div>
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
                section: 'taskSection',
                task: this.data,
                department: '',
                complete: false
            }
        },
        watch: {
            'data': function() {
                this.task = this.data;
            }
        },
        methods: {
            startTimer(){
                this.submit(this.route('api.task.timer.start', this.task.id), 'post', null, true, true)
            },
            stopTimer(){
                this.submit(this.route('api.task.timer.stop', this.task.id), 'post', null, true, true)
            },
            completeTask(){
                this.complete = true;
                this.submit(this.route('api.task.complete', this.task.id), 'post', null, true, true)
            },
            successHandler(){
                this.updateList();
                if(this.complete){
                    $(this.$el).modal('hide');
                }
            }
        }
    }
</script>

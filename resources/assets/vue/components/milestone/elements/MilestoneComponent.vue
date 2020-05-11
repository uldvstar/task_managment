<template>
    <div class="card mb-3 parentContainer">
        <div class="row pt-3 pb-3 pr-4 pl-4">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-1">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="ist-item-heading truncate mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{milestone.order}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">name</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{milestone.name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">Total Tasks</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{milestone.tasks.length}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-outline-info icon-button mr-3 toggleCollapse" data-type="taskSection"><i class="iconsminds-arrow-down"></i></button>
                        <button type="button" class="btn btn-outline-secondary icon-button mr-3 requestModal" data-type="editModal"><i class="iconsminds-pen-2"></i></button>
                        <button type="button" class="btn btn-outline-danger icon-button requestModal" data-type="deleteModal"><i class="simple-icon-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse" data-type="taskSection">
            <div class="card card-body pt-2">
                <div class="row align-items-center mb-3">
                    <div class="col">
                        <p class="text-uppercase m-0">Tasks</p>
                    </div>
                    <div class="col-auto pr-2">
                        <div class="top-right-button-container parentContainer">
                            <i class="iconsminds-add top-right-button requestModal text-primary pointer" data-type="createModal" style="font-size: 35px;"></i>
                            <form-component section="milestoneSection">
                                <template slot="form" slot-scope="{section}">
                                    <milestone-task-form-component :section="section" :id="milestone.id"></milestone-task-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row" v-for="item in milestone.tasks" v-bind:key="item.id" :data="item">
                            <div class="col">
                                <milestone-task-component :data="item"></milestone-task-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form-component section="milestoneSection" :data="milestone">
            <template slot="form" slot-scope="{section, data}">
                <milestone-form-component :section="section" :data="data"></milestone-form-component>
            </template>
        </form-component>
        <delete-component section="milestoneSection" :requestRoute="route('api.milestone.delete', milestone.id)" name="milestone"></delete-component>
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
                milestone: this.data,
            }
        },
        watch: {
          'data': function() {
              this.milestone = this.data;
          }
        }
    }
</script>

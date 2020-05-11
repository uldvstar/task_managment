<template>
    <div class="card mb-3 parentContainer">
        <div class="row pt-3 pb-3 pr-4 pl-4">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">reference</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{project.reference}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">type_id</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="ist-item-heading truncate mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{project.project_type}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">client</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{project.client.marking}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">status</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{project.current_status}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-outline-secondary icon-button mr-3 requestModal" data-type="editModal"><i class="iconsminds-pen-2"></i></button>
                        <button type="button" class="btn btn-outline-danger icon-button requestModal" data-type="deleteModal"><i class="simple-icon-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <form-component section="projectSection" :data="project">
            <template slot="form" slot-scope="{section, data}">
                <project-form-component :section="section" :data="data"></project-form-component>
            </template>
        </form-component>
        <delete-component section="projectSection" :requestRoute="route('api.project.delete', project.id)" name="project"></delete-component>
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
                project: this.data,
            }
        },
        watch: {
          'data': function() {
              this.project = this.data;
          }
        }
    }
</script>

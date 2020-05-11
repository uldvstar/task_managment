<template>
    <div class="card mb-3 parentContainer">
        <div class="row pt-3 pb-3 pr-4 pl-4">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-3">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">name</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="ist-item-heading truncate mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{department.name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">Head of Department</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{department.manager.name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class=" mb-1 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block text-muted text-small text-uppercase" style=" font-size: 9px !important; ">description</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-small mb-0 w-xs-100 mt-0">
                                    <span class="align-middle d-inline-block">{{department.description}}</span>
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
        <form-component section="departmentSection" :data="department">
            <template slot="form" slot-scope="{section, data}">
                <department-form-component :section="section" :data="data"></department-form-component>
            </template>
        </form-component>
        <delete-component section="departmentSection" :requestRoute="route('api.department.delete', department.id)" name="department"></delete-component>
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
                department: this.data,
            }
        },
        watch: {
          'data': function() {
              this.department = this.data;
          }
        }
    }
</script>

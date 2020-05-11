@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Departments</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="departmentSection">
                                <template slot="form" slot-scope="{section}">
                                    <department-form-component :section="section"></department-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="departmentSection" endpoint="{{ route('api.department.list') }}">
                    <template slot="list" slot-scope="{data}">
                        <department-component :data="data"></department-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <department-filters-component section="departmentSection"></department-filters-component>
@endsection
@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Project Milestones</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="projectMilestoneSection">
                                <template slot="form" slot-scope="{section}">
                                    <project-milestone-form-component :section="section"></project-milestone-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="projectMilestoneSection" endpoint="{{ route('api.project_milestone.list') }}">
                    <template slot="list" slot-scope="{data}">
                        <project-milestone-component :data="data"></project-milestone-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <project-milestone-filters-component section="projectMilestoneSection"></project-milestone-filters-component>
@endsection
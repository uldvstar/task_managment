@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Milestone Task Assignees</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="milestoneTaskAssigneeSection">
                                <template slot="form" slot-scope="{section}">
                                    <milestone-task-assignee-form-component :section="section"></milestone-task-assignee-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="milestoneTaskAssigneeSection" endpoint="{{ route('api.milestone_task_assignee.list') }}">
                    <template slot="list" slot-scope="{data}">
                        <milestone-task-assignee-component :data="data"></milestone-task-assignee-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <milestone-task-assignee-filters-component section="milestoneTaskAssigneeSection"></milestone-task-assignee-filters-component>
@endsection
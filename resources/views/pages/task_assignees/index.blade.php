@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Task Assignees</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="taskAssigneeSection">
                                <template slot="form" slot-scope="{section}">
                                    <task-assignee-form-component :section="section"></task-assignee-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="taskAssigneeSection" endpoint="{{ route('api.task_assignee.list') }}">
                    <template slot="list" slot-scope="{data}">
                        <task-assignee-component :data="data"></task-assignee-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <task-assignee-filters-component section="taskAssigneeSection"></task-assignee-filters-component>
@endsection
@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Tasks</h3>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
                <list-component key="2" section="taskSection" endpoint="{{ route('api.task.list') }}" :options="{order_by: {column: 'id', DESC: false}, active: true}" >
                    <template slot="list" slot-scope="{data}">
                        <task-component :data="data"></task-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <task-filters-component section="taskSection"></task-filters-component>
@endsection
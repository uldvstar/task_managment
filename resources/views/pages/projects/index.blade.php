@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Projects</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="projectSection">
                                <template slot="form" slot-scope="{section}">
                                    <project-form-component :section="section"></project-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="projectSection" endpoint="{{ route('api.project.list') }}">
                    <template slot="list" slot-scope="{data}">
                        <project-component :data="data"></project-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <project-filters-component section="projectSection"></project-filters-component>
@endsection
@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">{{$businessService->name}}<i class="iconsminds-arrow-right ml-2 mr-2"></i>Milestones</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="milestoneSection">
                                <template slot="form" slot-scope="{section}">
                                    <milestone-form-component :section="section" :id={{$businessService->id}}></milestone-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="milestoneSection" endpoint="{{ route('api.milestone.list', $businessService->id) }}" :options="{order_by: {column: 'order', DESC: false}}">
                    <template slot="list" slot-scope="{data}">
                        <milestone-component :data="data"></milestone-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

@endsection
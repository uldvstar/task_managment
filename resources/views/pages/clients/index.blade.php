@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Customers</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="clientSection">
                                <template slot="form" slot-scope="{section}">
                                    <client-form-component :section="section"></client-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="clientSection" endpoint="{{ route('api.client.list') }}">
                    <template slot="list" slot-scope="{data}">
                        <client-component :data="data"></client-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <client-filters-component section="clientSection"></client-filters-component>
@endsection
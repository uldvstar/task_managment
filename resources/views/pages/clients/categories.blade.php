@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Customer Groups</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="clientTypeSection">
                                <template slot="form" slot-scope="{section, data}">
                                    <modular-type-form-component :section="section" type="client"></modular-type-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="clientTypeSection" endpoint="{{ route('api.modular_type.list', 'client') }}">
                    <template slot="list" slot-scope="{data}">
                        <modular-type-component :data="data"></modular-type-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <modular-type-filters-component section="clientTypeSection"></modular-type-filters-component>
@endsection
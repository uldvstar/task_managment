@extends('layouts.base_portal')
@section('inner_content')
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="row align-items-center mb-5">
                    <div class="col">
                        <h3 class="text-uppercase m-0">Comments</h3>
                    </div>
                    <div class="col-auto">
                        <div class="top-right-button-container parentContainer">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
                            <form-component section="commentSection">
                                <template slot="form" slot-scope="{section}">
                                    <comment-form-component :section="section"></comment-form-component>
                                </template>
                            </form-component>
                        </div>
                    </div>
                </div>
                <list-component key="2" section="commentSection" endpoint="{{ route('api.comment.list') }}">
                    <template slot="list" slot-scope="{data}">
                        <comment-component :data="data"></comment-component>
                    </template>
                </list-component>
            </div>
        </div>
    </div>

    <comment-filters-component section="commentSection"></comment-filters-component>
@endsection
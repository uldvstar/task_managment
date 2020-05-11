<template>
<div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <p class="text-muted text-small">Filter</p>
                <div class="row">
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row mb-3 animated fadeInDown fast">
                                    <div class="col">
                                        <label class="form-group has-float-label mb-1">
                                            <input v-model="parameters.title" type="text" class="form-control">
                                            <span>title</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3 animated fadeInDown fast">
                                    <div class="col">
                                        <label class="form-group has-float-label mb-1">
                                            <selectable-component  :endpoint="route('api.modular_type.list', 'status')" section="statusTypeSection" valueColumn="id" labelColumn="name" v-model="parameters.status"></selectable-component>
                                            <span>status</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3 animated fadeInDown fast">
                                    <div class="col">
                                        <label class="form-group has-float-label mb-1">
                                            <selectable-component  :endpoint="route('api.modular_type.list', 'task')" section="taskTypeSection" valueColumn="id" labelColumn="name" v-model="parameters.type_id"></selectable-component>
                                            <span>type</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-secondary btn-block" @click="updateFilters()">Search</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-center">
                                        <small class="text-small text-muted pointer" @click="resetForm();updateFilters()">Clear Search Filters</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            section: {
               type: String,
               required: true
            }
        },
        data(){
            return {
                parameters: {
                    milestone_id: '',
                    type_id: '',
                    title: '',
                    description: '',
                    status: ''
                },
            }
        }
    }
</script>

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
                                <input v-model="parameters.assignee_id" type="text" class="form-control">
                                <span>assignee_id</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <label class="form-group has-float-label mb-1">
                                <input v-model="parameters.assignee_type" type="text" class="form-control">
                                <span>assignee_type</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3 animated fadeInDown fast">
                        <div class="col">
                            <label class="form-group has-float-label mb-1">
                                <input v-model="parameters.assignment_id" type="text" class="form-control">
                                <span>assignment_id</span>
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
                    assignee_id: '',
                    assignee_type: '',
                    assignment_id: ''
                },
            }
        }
    }
</script>

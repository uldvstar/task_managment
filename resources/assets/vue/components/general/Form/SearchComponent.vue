<template>
    <div class="row no-margin hint-text">
        <div class="col bg-master-lightest p-b-15 hint-text">
            <div class="row m-b-15 p-t-10 p-b-10 bg-master-lighter">
                <div class="col">
                    <small class="all-caps muted fs-10">Filters</small>
                </div>
                <div class="col-auto">
                    <div class="row align-items-center text-info pointer">
                        <div class="col-auto p-r-0"><small class="all-caps fs-10">Advance</small></div>
                        <div class="col-auto p-l-0"><i class="fa fa-chevron-down fs-8 m-l-5" style=" margin-bottom: 3px; "></i></div>
                    </div>
                </div>
            </div>
            <user-filters-component></user-filters-component>
            <div class="row m-t-15">
                <div class="col">
                    <div class="bg-transparent text-center b-success b-a text-success fs-10 all-caps bold b-rad-none p-t-10 p-b-10 p-r-25 p-l-25 pointer" @click="updateFilters()">
                        Apply filters
                    </div>
                </div>
            </div>
            <div class="row m-t-10 text-center">
                <div class="col">
                    <small class="all-caps fs-9 text-danger pointer" @click="clearFilters">Clear Filters</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                filters: {},
            }
        },
        methods:{
            updateFilters(){
                Object.keys(this.filters).forEach((key) => (this.filters[key] === '') && delete this.filters[key]);
                this.$parent.$data.filters = this.filters;
                this.$parent.fetchList();
            },
            clearFilters(){
                this.$parent.$data.filters = {};
                this.$parent.fetchList();
            }
        }
    }
</script>
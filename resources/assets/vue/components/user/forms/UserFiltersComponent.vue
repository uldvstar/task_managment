<template>
    <div class="row">
        <div class="col">
            <div class="row no-margin b-b b-grey">
                <div class="col no-padding">
                    <input placeholder="name" v-model="filters.user_name" @change="updateFilters" class="form-control no-border bg-white p-t-20 p-b-20 p-l-10 p-r-10">
                </div>
                <div class="col-auto bg-white">
                    <i class="fa fa-times lh-40 fs-10 muted hint-text pointer"></i>
                </div>
            </div>
            <div class="row no-margin">
                <div class="col no-padding">
                    <input placeholder="email address" v-model="filters.email" @change="updateFilters" class="form-control no-border bg-white p-t-20 p-b-20 p-l-10 p-r-10">
                </div>
                <div class="col-auto bg-white">
                    <i class="fa fa-times lh-40 fs-10 muted hint-text pointer"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                filters: {
                    user_name: '',
                    email: '',
                },
            }
        },
        methods:{
            updateFilters(){
                this.$parent.$data.filters = this.filters;
            }
        }
    }
</script>

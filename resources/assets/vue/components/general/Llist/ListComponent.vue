<template>
    <transition-component group enter-class="animated fadeInRightBig delay-1 faster" leave-class="animated fadeOutRightBig faster">
        <loading-component style="height: 200px; top: 0;" key="1" color="success" v-show="$store.getters.isLoading(section)"></loading-component>
        <div class="row" key="2" v-show="!$store.getters.isLoading(section)">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="row align-items-center justify-content-center pt-5 pb-5" v-if="!$store.getters.getListData(section).length">
                            <div class="col-10 pt-5">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-9 text-center mb-5">
                                        <i class="iconsminds-folder-open" style="font-size: 50px;"></i>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <p class="text-uppercase m-0" style="letter-spacing: 2px;">No Results Found</p>
                                            </div>
                                        </div>
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col">
                                                <small class="text-uppercase" style="letter-spacing: 2px">Try adjusting your filters to find what you are looking for.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="list disable-text-selection" data-check-all="checkAll">
                                    <div class="row" v-for="item in $store.getters.getListData(section)" v-bind:key="item.id" :data="item">
                                        <div class="col">
                                            <slot name="list" :data="item"></slot>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <pagination-component :section="section" class="mb-5" ref="pagination"></pagination-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition-component>
</template>

<script>
    export default {
        props: {
            section:{
                type: String,
                required: true
            },
            endpoint: {
                type: String,
                required: true
            },
            options: {
                default () {
                    return {}
                }
            }
        },
        data(){
            return {
                filters: this.options
            }
        },
        validations: {},
        created(){
            this.setDecoratorDefault();
            this.$store.dispatch('updateListQueue', {'name': this.section, 'page': 1, 'filters': this.filters});
        },
        computed: {
            pendingList () {
                return this.$store.getters.isInCompleteQueue(this.section);
            }
        },
        watch: {
            pendingList(inComplete){
                if(inComplete){
                    this.fetchList();
                }
            }
        },
        methods: {
            fetchList(){
                let listDecorators = this.$store.getters.getListDetails(this.section);
                this.submit(this.endpoint + '?page=' + listDecorators.page + '&filters=' + JSON.stringify(listDecorators.filters), 'get', this.section, false, false)
            },
            successHandler(response){
                this.$store.dispatch('completeList', {'name': this.section, 'data': response.payload.data});
                this.$refs.pagination.makePagination(response.payload.meta, response.payload.links);
            },
        }
    }
</script>

<template>
    <div class="row no-margin" v-if="!pagination">
        <div class="col">
            <ul class="pagination justify-content-center mb-0"  v-if="pagination.last_page !== 1">
                <li class="page-item " :class="[{'disabled': pagination.current_page === 1 && pageNumbers().includes(1)}]" @click="callPage(1)">
                    <a class="page-link first" href="#">
                        <i class="simple-icon-control-start"></i>
                    </a>
                </li>
                <li class="page-item" v-for="n in pageNumbers()" @click="callPage(n)" :class="[{'active': n === pagination.current_page}]">
                    <a class="page-link" href="#">{{n}}</a>
                </li>
                <li class="page-item" :class="[{'disabled': pagination.current_page === pagination.last_page && !pageNumbers().includes(pagination.last_page)}]" @click="callPage(pagination.last_page)" >
                    <a class="page-link last" href="#">
                        <i class="simple-icon-control-end"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            section:{
                type: String,
                required: true
            }
        },
        data(){
            return {
                pagination: {}
            }
        },
        methods: {
            makePagination(pagination){
                this.pagination = pagination;
            },
            callPage(page){
                if(page !== this.pagination.current_page){
                    this.$store.dispatch('updateListQueue', {'name': this.section, 'page': page, 'filters': this.$store.getters.getListDetails(this.section).filters});
                }
            },
            pageNumbers(){
                let pages = 5;
                let numbers = [],
                    partition = (pages - 1) / 2,
                    previousOverflow = -(this.pagination.current_page - partition - 1),
                    nextOverflow = -(this.pagination.last_page - (this.pagination.current_page + partition)),
                    previous = partition + (nextOverflow > 0 ? nextOverflow : 0),
                    next = partition + (previousOverflow > 0 ? previousOverflow : 0);

                for (let i = this.pagination.current_page - previous; i < this.pagination.current_page; i++) {
                    if(i >= 1) {
                        numbers.push(i);
                    }
                }

                numbers.push(this.pagination.current_page);

                for (let i = this.pagination.current_page + 1; i <= (this.pagination.current_page + next); i++) {
                    if(i <= this.pagination.last_page) {
                        numbers.push(i);
                    }
                }


                return numbers
            }
        }
    }
</script>

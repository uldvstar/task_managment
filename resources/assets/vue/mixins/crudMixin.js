export default {
    methods: {
        crudSuccess(){
            this.closeModal();
            this.updateList();
            this.resetForm();

        },
        resetForm(){
            if(!this.data) {
                Object.assign(this.$data, this.$options.data.call(this));
            }
        },
        updateFilters(){
            if(this.$store.getters.isInQueue(this.section)){
                this.filters = this.$store.getters.getListDetails(this.section).filters;
            } else {
                this.setDecoratorDefault();
            }

            let vm = this;
            $.each(this.parameters, function(key, value) {
                value ? (vm.filters[key] = value) : (key in vm.filters && delete vm.filters[key]);
            });

            this.$store.dispatch('updateListQueue', {'name': this.section, 'page': 1, 'filters': this.filters});
        },
        updateList(){
            this.$store.dispatch('reloadList', {'name': this.section});
        },
        closeModal(){

            if(this.$v){
                this.$v.$reset();
            }

            $(this.$el).parents('.modal').modal('hide');

            this.resetForm();
        },
        setDecoratorDefault(){
            this.filters.per_page = this.filters.per_page !== undefined ? this.filters.per_page : 10;
            this.filters.order_by = this.filters.order_by !== undefined ? this.filters.order_by : {
                column: 'id',
                DESC: true
            };
        }
    }

}
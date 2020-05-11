<template>
    <select class="form-control">
        <option disabled></option>
    </select>
</template>
<script>
    import PerfectScrollbar from 'perfect-scrollbar';
    export default {
        props: {
            options: {
                type: Array,
                required: true
            },
            value: {
                required: false
            }
        },
        mounted(){
            let vm = this;
            $(this.$el).select2({
                data: this.options,
                minimumResultsForSearch: 6,
                theme: 'bootstrap',
                containerCssClass: 'form-control',
            }).val(this.value).trigger("change").on('change', function(){
                vm.$emit('input', this.value);
            }).on('select2:open', function(){
                new PerfectScrollbar('.select2-results__options', {
                    wheelSpeed: 1,
                    wheelPropagation: true,
                    minScrollbarLength: 10
                })
            })
        },
        watch: {
            value: function(value){
                $(this.$el).val(value).trigger('change');
            },
            options: function(options){
                $(this.$el).select2({ data: options });
                this.value ? $(this.$el).val(this.value).trigger('change'):null;
            }
        },
        destroyed: function(){
            $(this.$el).off().select2('destroy')
        }
    }
</script>
<style>
    .select2-results__options {
        position: relative;
        max-height: 200px
    }
</style>

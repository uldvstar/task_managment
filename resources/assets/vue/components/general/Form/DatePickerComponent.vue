<template>
    <input type="text" class="form-control" :value="date">
</template>

<script>
    export default {
        props: ['value'],
        data() {
            return {
                date: this.value
            }
        },
        mounted: function() {
            let vm = this;
            $(this.$el).datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                todayBtn: true,
                todayHighlight: true
            }).on('changeDate',function(event){
                vm.$emit('input', event.target.value);
            })
        },
        watch: {
            'value': function() {
                this.date = this.value;
            }
        },
    }
</script>

<template>
    <select-component  :options="$store.getters.getSelectableList(section)" :value="value" @input="(val) => {$emit('input', val)}"></select-component>
</template>
<script>

    export default {
        props: {
            value: {
                required: false
            },
            section: {
                type: String,
                required: true
            },
            endpoint: {
                type: String,
                required: true
            },
            labelColumn: {
                type: String,
                required: true
            },
            valueColumn: {
                type: String,
                required: true
            }
        },
        created(){
            if(!this.$store.getters.isInQueue(this.section)){
                this.$store.dispatch('updateListQueue', {name: this.section});
                this.$store.dispatch('crudRequest', {endpoint: this.endpoint, method: 'get'}).then(response => {
                    let success = response.ok;
                    response.json().then(response => {

                        if(!success){return;}

                        let vm = this;
                        let mappedList = $.map(response.payload.data, function(value){
                            return {'id': !isNaN(value[vm.valueColumn]) ? parseInt(value[vm.valueColumn]) : value[vm.valueColumn], 'text': value[vm.labelColumn]};
                        });

                        this.$store.dispatch('completeList', {name: this.section, data: mappedList})

                    });
                })
            }
        }
    }
</script>


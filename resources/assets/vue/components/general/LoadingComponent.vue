<template>
    <div class="row align-items-center justify-content-center w-100">
        <div class="col">
            <hollow-dots-spinner :animation-duration="1000" :dots-num="5" :color="getColor" class="m-auto"></hollow-dots-spinner>
        </div>
    </div>
</template>
<script>
    import { HollowDotsSpinner  } from 'epic-spinners';

    export default {
        props: {
            color: {
                type: String,
                default: 'primary'
            }
        },
        components: {
            HollowDotsSpinner
        },
        computed: {
            getColor(){
               switch (this.color) {
                   case 'primary':
                       return '#576a3d';
                   case 'success':
                       return '#28a745';
                   case 'danger':
                       return '#dc3545'
               }
            }
        }
    }
</script>

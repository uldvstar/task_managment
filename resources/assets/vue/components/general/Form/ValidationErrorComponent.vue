<template>
    <div v-if="validator.$error" class="text-danger">
        <small class="bold" v-for="(object, param) in validator.$params" v-if="!validator[param]">
            {{errorMessages[param]}}
            <span v-if="object.type === 'minLength'">{{object.min}} characters</span>
            <span v-if="object.type === 'sameAs'">{{object.eq}} field</span>
        </small>
    </div>
</template>

<script>
    export default {
        props: {
            validator: {
                required: true
            }
        },
        data(){
            return {
                errorMessages:{
                    required: 'this field is required',
                    email: 'enter a valid email address',
                    minLength: 'this field must have at least',
                    sameAs: 'this field must match the'
                },
            }
        },
        methods: {

        }
    }
</script>

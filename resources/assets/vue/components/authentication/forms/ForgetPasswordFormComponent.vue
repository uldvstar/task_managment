<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="row mb-3 animated fadeInUpBig fast" v-if="error">
                        <div class="col">
                            <small class="font-weight-bold text-danger">{{error}}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row animated bounceInRight slow">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.email">
                                <input v-model="parameters.email" class="form-control">
                                <span>Email Address</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <div class="row">
                        <div class="col pt-4 text-uppercase animated bounceInLeft slow" style="letter-spacing: 3px; font-size: 10px;">
                            <small @click="$store.dispatch('toggleSection', {name: 'forgetPassword', status: false})" class="pointer"><i class="fa fa-angle-left"></i> Back to login</small>
                        </div>
                        <div class="col-auto">
                            <div class="btn btn-primary btn-lg btn-shadow animated bounceInRight slow" style="cursor: pointer" @click="submit(route('api.account.password.forget'), 'post', section, false , false)">Request Reset Link</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import { required, email } from "vuelidate/lib/validators";
    import request from '../../../mixins/requestMixin'
    export default {
        props: {
            section:{
                type: String,
                required: true
            }
        },
        data() {
            return {
                error: '',
                parameters: {
                    email: ''
                }
            };
        },
        validations: {
            parameters: {
                email: { required, email }
            }
        },
        methods:{
            successHandler(){
                this.$store.dispatch('toggleSection', {name: 'forgetPasswordSuccess', status: true})
                this.$store.dispatch('passwordResetEmail', {email: this.parameters.email})
            },
            errorHandler(error){
                this.error = error.message;
            }
        },
        mixins: [request]
    }

</script>
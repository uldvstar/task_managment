<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="row mb-3 animated fadeInUpBig fast" v-if="error">
                        <div class="col">
                            <small class="bold fs-10 text-danger">{{error}}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row mb-3 animated bounceInLeft slow">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.password">
                                <input v-model="parameters.password" type="password" class="form-control">
                                <span>New Password</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row animated bounceInRight slow">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.confirmPassword">
                                <input v-model="parameters.confirmPassword" type="password" class="form-control">
                                <span>Confirm Password</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col pt-4 text-uppercase animated bounceInLeft slow " style="letter-spacing: 3px; font-size: 10px;">
                            <a :href="route('login')" @click="$store.dispatch('toggleLoading', {name: 'resetPasswordSection', status: true})">
                                <small class="pointer"><i class="fa fa-angle-left" style="padding-right: 18px;"></i>Go to login</small>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="btn btn-primary btn-lg btn-shadow animated bounceInRight slow pointer" @click="submit(route('api.account.password.reset'), 'post', section, false , false)">Change Password</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import { required, minLength, sameAs } from "vuelidate/lib/validators";
    import request from '../../../mixins/requestMixin'
    export default {
        props: {
            section: {
                type: String,
                required: true
            },
            token: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                error: '',
                parameters: {
                    token: this.token,
                    password: '',
                    confirmPassword: ''
                }
            };
        },
        validations: {
            parameters: {
                password: {
                    required,
                    minLength: minLength(6)
                },
                confirmPassword: {
                    sameAs: sameAs('password')
                }
            }
        },
        methods:{
            successHandler(){
                this.$store.dispatch('toggleSection', {name: 'resetPasswordSuccess', status: true});
            },
            errorHandler(error){
                this.error = error.message;
            }
        },
        mixins: [request]
    }

</script>
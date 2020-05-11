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
                            <validation-wrapper-component :validator="$v.parameters.email">
                                <input v-model="parameters.email" class="form-control">
                                <span>E-mail Address</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                    <div class="row animated bounceInRight slow">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.password">
                                <input type="password" v-model="parameters.password" class="form-control">
                                <span>Password</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col pt-4 text-uppercase animated bounceInLeft slow " style="letter-spacing: 3px; font-size: 10px;">
                            <small @click="$store.dispatch('toggleSection', {name: 'forgetPassword', status: true})" class="pointer">Forget password?</small>
                        </div>
                        <div class="col-auto">
                            <div class="btn btn-primary btn-lg btn-shadow animated bounceInRight slow pointer" @click="submit(route('api.account.authenticate'), 'post', section, false, false)">LOGIN</div>
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
                    email: '',
                    password: ''
                }
            };
        },
        validations: {
            parameters: {
                email: { required, email },
                password: { required }
            }
        },
        methods:{
            successHandler(response){
                localStorage.setItem('user-token', response.payload.access_token);
                this.$store.dispatch('userAuthentication', {access_token: response.payload.access_token});

                this.error = '';
                this.$store.dispatch('toggleSection', {name: 'loginSuccess', status: true});
                setTimeout(function(){
                    window.location.href = route('task.dashboard');
                }, 2000);
            },
            errorHandler(error){
                this.$store.dispatch('userAuthentication', {access_token: ''});
                localStorage.removeItem('user-token');

                this.error = error.message;
            }
        },
        mixins: [request]
    }

</script>
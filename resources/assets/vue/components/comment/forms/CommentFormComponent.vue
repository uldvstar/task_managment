<template>
    <div class="row" v-on:keyup.enter="submitForm()">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="row mb-2 animated fadeInDown fast">
                        <div class="col">
                            <validation-wrapper-component :validator="$v.parameters.comment">
                                <textarea v-model="parameters.comment" class="form-control" rows="3"></textarea>
                                <span>Comments</span>
                            </validation-wrapper-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-primary default" @click="submitForm()">Add Comment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { required, email } from "vuelidate/lib/validators";
    export default {
        props: {
            section: {
               type: String,
               required: true
            },
            data: {
                type: Object,
                default: null
            },
            commentable: {
                type: Object,
                default: null
            }
        },
        created() {
            if(this.data){
                this.parameters = this.data;
            }

        },
        data() {
            return {
                parameters: {
                    comment: '',
                    commentable_id: this.commentable.commentable_id,
                    commentable_type: this.commentable.commentable_type,
                },
            };
        },
        validations: {
            parameters: {
                comment: { required }
            }
        },

        methods:{
            submitForm(){
                this.submit((this.data ? this.route('api.comment.update', this.data.id) : this.route('api.comment.create')), (this.data ? 'put' : 'post'), this.section+'.form', true, true)
            },
            successHandler(){
                this.updateList();
                this.resetForm();
                this.$v.$reset()

            }
        }
    }
</script>

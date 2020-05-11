<template>
    <div class="card mb-3 parentContainer">
        <div class="row pt-3 pb-3 pr-4 pl-4">
            <div class="col">
                <div class="row align-items-center">

                    <div class="col text-right">
                        <button type="button" class="btn btn-outline-secondary icon-button mr-3 requestModal" data-type="editModal"><i class="iconsminds-pen-2"></i></button>
                        <button type="button" class="btn btn-outline-danger icon-button requestModal" data-type="deleteModal"><i class="simple-icon-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <form-component section="commentSection" :data="comment">
            <template slot="form" slot-scope="{section, data}">
                <comment-form-component :section="section" :data="data"></comment-form-component>
            </template>
        </form-component>
        <delete-component section="commentSection" :requestRoute="route('api.comment.delete', comment.id)" name="comment"></delete-component>
    </div>
</template>
<script>
    export default {
        props: {
            data: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                comment: this.data,
            }
        },
        watch: {
          'data': function() {
              this.comment = this.data;
          }
        }
    }
</script>

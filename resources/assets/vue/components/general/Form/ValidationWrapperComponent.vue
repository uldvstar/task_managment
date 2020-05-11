<template>
    <div class="animated" :class="[{'shake': validator.$error}]">
        <div class="row">
            <div class="col">
                <label class="form-group has-float-label mb-1" :class="[{'is-invalid': validator.$error}]">
                    <slot></slot>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <validation-error-component :validator="validator" class="absolute fs-12" style=" top: 10px; right: 15px; z-index: 99;"></validation-error-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            validator: {
                required: true
            }
        }
    }
</script>
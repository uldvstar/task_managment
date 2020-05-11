<template>
    <div class="row parentContainer">
        <div class="col">
            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1 requestModal" data-type="createModal">ADD NEW</button>
            <form-component :section="section" >
                <template slot="form" slot-scope="{section}">
                    <component :is="(section.replace('Section', '')).replace(/[A-Z]/g, m => '-' + m.toLowerCase())+'-form-component'" project-form-component :section="section"></component>
                </template>
            </form-component>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            'section': {
                type: String,
                required: true
            }
        }
    }
</script>

<template>
    <div class="body">
        <div class="container">
            <UploadFilesComponent
                :vars="{name:'abc'}"
            />
        </div>
    </div>
</template>

<script>
import UploadFilesComponent from "./UploadFilesComponent.vue";
export default {
    components: {UploadFilesComponent}
}
</script>

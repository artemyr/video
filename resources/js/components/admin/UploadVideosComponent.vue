<template>
    <div class="mb-4">
        <upload-files-component
            label="Загрузить виедо"
            :multiply="true"
            :downloads="[]"
        ></upload-files-component>
    </div>

    <div v-html="listHtml"></div>
</template>

<script>
import UploadFilesComponent from "./UploadFilesComponent.vue";
export default {
    components: {UploadFilesComponent},
    data() {
        return {
            listHtml: ''
        }
    },
    mounted() {
        this.updateList()
    },
    methods: {
        updateList() {
            let urlOb = new URL(location.href)
            let url = '/admin/media/list'
            if (urlOb.searchParams.has('page')) {
                url += '?page=' + urlOb.searchParams.get('page')
            }
            axios.get(url)
                .then(response => {
                    this.listHtml = response.data
                })
        }
    }
}
</script>

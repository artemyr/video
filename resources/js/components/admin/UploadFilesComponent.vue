<template>
    <div class="admin-edit__files">
        <p>{{ vars.name }}</p>
        <div class="" v-if="fileProgress">
            <div class="progress-bar" :style="{ width: fileProgress + '%' }">{{ fileCurrent }}%</div>
        </div>
        <div class="admin-edit__file" v-for="(download, index) in downloads">
            <input type="hidden" name="downloads[]" v-model="download.id">
            <div class="form-group">
                <input type="text" placeholder="Подпись для файла" v-model="download.title">
            </div>
            <div class="admin-edit__input-group">
                <div>
                    <template class="" v-if="download.is_new">
                        <input type="file" id="customFile" @change="fileInputChange(download)">
                        <button type="button" @click="uploadFile(download)">Загрузить</button>
                    </template>
                </div>
                <div>
                    <button type="button" @click="deleteFile(index)">Удалить</button>
                </div>
            </div>
        </div>
        <button v-if="multiply" type="button" @click="addFile">Добавить</button>
    </div>
</template>

<script>
export default {
    data () {
        return {
            downloads: [],
            fileProgress:0,
            fileCurrent:'',
        }
    },
    props: ['vars', 'multiply'],
    mounted() {
        // this.downloads = this.$parent.entity[this.vars.id];
        // if (this.downloads.length > 0) {
        //     this.updateList();
        // } else {
        //     this.addFile();
        //     this.updateList();
        // }
    },
    methods: {
        addFile() {
            this.downloads.push({id: 0, title: '', file: [], is_new: true});
        },
        updateList() {
            this.$parent.entity[this.vars.id] = [];
            this.downloads.forEach(el => {
                this.$parent.entity[this.vars.id].push(el.id)
            })
        },
        deleteFile(index) {

            if (this.downloads[index].is_new){
                this.downloads.splice(index, 1);

                this.updateList();
                return;
            }

            axios.delete('/admin/download/' + this.downloads[index].id)
            .then(response => {
                if (response.data.result) {
                    this.downloads.splice(index, 1);

                    this.updateList();
                }
            })
        },
        fileInputChange (download) {
            download.file = event.target.files[0];
        },
        async uploadFile (download) {
            let form = new FormData();
            form.append('file', download.file);
            form.append('title', download.title);

            await axios.post('/admin/download', form, {
                onUploadProgress: (itemUpload) => {
                    this.fileProgress = Math.round( (itemUpload.loaded / itemUpload.total) *100 );
                    this.fileCurrent = download.title + ' ' + this.fileProgress;
                }
            })
            .then(response => {
                download.id = response.data;
                download.is_new = false;
            })
            .catch(error => {
                console.log(error);
            })

            this.updateList();

            this.fileProgress = 0;
            this.fileCurrent = '';
        }
    }
}
</script>

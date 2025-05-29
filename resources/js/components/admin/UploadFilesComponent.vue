<template>
    <div class="admin-edit__files">
        <p>{{ label }}</p>
        <div class="" v-if="fileProgress">
            <div class="progress-bar" :style="{ width: fileProgress + '%' }">{{ fileCurrent }}%</div>
        </div>
        <div class="admin-edit__file" v-for="(download, index) in _downloads">
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
            _downloads: [],
            fileProgress:0,
            fileCurrent:'',
        }
    },
    props: ['label', 'multiply', 'downloads'],
    mounted() {
        this._downloads = this.downloads;
        if (this.downloads.length < 1) {
           this.addFile();
        }
    },
    methods: {
        addFile() {
            this._downloads.push({id: 0, title: '', file: [], is_new: true});
        },
        deleteFile(index) {

            if (this._downloads[index].is_new){
                this._downloads.splice(index, 1);

                // this.updateList();
                return;
            }

            axios.delete('/admin/download/' + this._downloads[index].id)
            .then(response => {
                if (response.data.result) {
                    this._downloads.splice(index, 1);

                    // this.updateList();
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

            // this.updateList();

            this.fileProgress = 0;
            this.fileCurrent = '';
        }
    }
}
</script>

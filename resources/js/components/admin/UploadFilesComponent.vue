<template>
    <div class="">
        <p>{{ label }}</p>
        <div class="bg-gray-600 w-full" v-if="fileProgress">
            <div class="bg-green text-center" :style="{ width: fileProgress + '%' }">{{ fileCurrent }}%</div>
        </div>
        <div class="grid grid-flow-col justify-start items-end gap-4" v-for="(download, index) in _downloads">
            <input type="hidden" name="downloads[]" v-model="download.id">
            <div>
                <input type="text" class="text-black" placeholder="Подпись для файла" v-model="download.title">
                <div v-if="download.is_new">
                    <input type="file" id="customFile" @change="fileInputChange(download)">
                    <button v-if="download.file" class="btn-success" type="button" @click="uploadFile(download)">Загрузить</button>
                </div>
            </div>
            <div>
                <button class="btn-danger" type="button" @click="deleteFile(index)">Удалить</button>
            </div>
        </div>
        <button v-if="multiply" type="button" class="btn-success" @click="addFile">Добавить</button>
    </div>
</template>

<script>
export default {
    data () {
        return {
            _downloads: [],
            fileProgress: 0,
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
            this._downloads.push({id: 0, title: '', file: false, is_new: true});
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

            this.$parent.updateList()

            this.fileProgress = 0;
            this.fileCurrent = '';
        }
    }
}
</script>

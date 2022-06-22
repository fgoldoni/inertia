import { ref } from 'vue'


export const useMedia = ref({

    dragging: false,

    media: [],

    error: null,

    doRemoveFile(index, item) {

        this.media.splice(index, 1)

        if (item.id) {

            axios.delete(route('api.attachments.destroy', item.id))
                .catch(error => {
                    this.media.splice(index, 0, item)

                    this.media.error = `Upload failed. Please try again later.`;

                    if (error?.response.status === 422) {
                        this.media.error = error.response.data.errors.file[0];
                    }
                });
        }
    },

    push(file) {
        this.media.unshift(file)
    },

    doDroppedFiles($event) {

        this.dragging = false;

        let files = [...$event.dataTransfer.items]
            .filter(item => item.kind === 'file')
            .map(item => item.getAsFile());

        this.doUploadFiles(files);
    },

    doSelectedFiles ($event) {

        let files = [...$event.target.files];

        this.doUploadFiles(files);
    },

    doUploadFiles (files) {

        files.forEach(file => {

            this.media.unshift({
                file: file,
                url: null,
                progress: 0,
                error: null,
                uploaded: false,
            });

            this.doSubmitFiles()

        });
    },
    doSubmitFiles () {

        this.media.filter(media => !media.uploaded).forEach(media => {

                let form = new FormData;

                form.append('file', media.file);

                axios.post(route('api.attachments.store'), form, {
                    onUploadProgress: (event) => {
                        media.progress = Math.round(event.loaded * 100 / event.total);
                    },
                })
                    .then((res) => {
                        media.id = res.data.data.id
                        media.url = res.data.data.url
                        media.uploaded = true
                    })

                    .catch(error => {
                        media.error = `Upload failed. Please try again later.`;

                        if (error?.response.status === 422) {
                            media.error = error.response.data.errors.file[0];
                        }
                    });
            });
    }
})

import { ref } from 'vue'


export const useMedia = ref({

    dragging: ref(false),

    media: ref([]),

    error: ref(null),

    doRemoveFile(index, item) {
        this.media.splice(index, 1)
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

            let reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = async (e) => {

                this.media.unshift({
                    file: file,
                    url: e.target.result,
                    progress: 0,
                    error: null,
                    uploaded: false,
                });

                this.doSubmitFiles()

            }

        });
    },
    doSubmitFiles () {

        this.media.filter(media => !media.uploaded).forEach(media => {

                let form = new FormData;

                form.append('file', media.file);

                axios.post(route('admin.attachments.store'), form, {
                    onUploadProgress: (event) => {
                        media.progress = Math.round(event.loaded * 100 / event.total);
                    },
                })
                    .then(() => media.uploaded = true)

                    .catch(error => {
                        media.error = `Upload failed. Please try again later.`;

                        if (error?.response.status === 422) {
                            media.error = error.response.data.errors.file[0];
                        }
                    });
            });
    }
})

import {ref} from 'vue'


export const useAvatar = ref({

    media: null,

    error: null,

    baseUrl : document.querySelector('meta[name="baseUrl"]').content,

    push (item) {
        this.media = item
    },

    doRemoveFile(defaultSrc) {

        if (this.media.avatar_path) {

            axios.delete(route('api.avatars.destroy', encodeURIComponent(this.media.avatar_path)))
                .then(() => {
                    this.media.avatar_path = null
                    this.media.avatar_url = defaultSrc
                })
                .catch(error => {
                    this.media.error = `Upload failed. Please try again later.`;
                    if (error?.response.status === 422) {
                        this.media.error = error.response.data.errors.file[0];
                    }
                });
        }
    },

    doLoadFile (filename, defaultSrc) {

        let avatar_url = defaultSrc
        let avatar_path = null

        if (filename && typeof filename === 'string') {
            avatar_url = `${ this.baseUrl }/avatars/${ filename }`
            avatar_path = filename
        }

            this.push({
            id: null,
            file: null,
            avatar_url: avatar_url,
            avatar_path: avatar_path,
            progress: 100,
            error: null,
            uploaded: true,
        });
    },

    doSubmitFile(file) {

        let form = new FormData;

        form.append('file', file);




        axios.post(route('api.avatars.store'), form)
            .then((res) => {

                this.push({
                    avatar_url: `${ this.baseUrl }/avatars/${ res.data.data.filename }`,
                    avatar_path: res.data.data.filename,
                    progress: 100,
                    error: null,
                    uploaded: true,
                });

            })

            .catch(error => {
                this.media.error = `Upload failed. Please try again later.`;

                if (error?.response.status === 422) {
                    this.media.error = error.response.data.errors.file[0];
                }
            });
    }
})

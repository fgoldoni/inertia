import { ref } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3';

export function useJobs() {

    const data = ref({
        data: null
    })

    const error = ref(false)

    const processing = ref(false)

    const doFetchData = async (id) => {
        processing.value = true

        await axios.get(route('api.jobs.show', usePage().props.value.auth.user?.id)).then((res) => (data.value = res.data))
            .catch((err) => (error.value = err))
            .finally(() => (processing.value = false))
    }


    return { processing, error, data, doFetchData }
}

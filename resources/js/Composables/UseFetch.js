import { ref } from 'vue'

export function useFetch() {

    const data = ref({
        data: null
    })

    const error = ref(false)

    const processing = ref(false)

    const doFetchData = async (url) => {
        processing.value = true

        await axios.get(url).then((res) => (data.value = res.data))
            .catch((err) => (error.value = err))
            .finally(() => (processing.value = false))
    }

    return { processing, error, data , doFetchData }
}

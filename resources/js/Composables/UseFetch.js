import { ref } from 'vue'

export function useFetch() {

    const data = ref({
        data: null,
        activities: null,
        users: null
    })

    const error = ref(false)

    const processing = ref(false)

    const doInitData = (item) => data.value.data = item

    const doFetchData = async (url) => {
        processing.value = true

        await axios.get(url).then((res) => (data.value = res.data))
            .catch((err) => (error.value = err))
            .finally(() => (processing.value = false))
    }

    const doFetchDataActivities = async (url) => {
        processing.value = true

        await axios.get(url).then((res) => (data.value.activities = res.data))
            .catch((err) => (error.value = err))
            .finally(() => (processing.value = false))
    }

    const doFetchDataUsers = async (url) => {
        processing.value = true

        await axios.get(url).then((res) => (data.value.users = res.data))
            .catch((err) => (error.value = err))
            .finally(() => (processing.value = false))
    }

    return { processing, error, data , doInitData, doFetchData, doFetchDataActivities, doFetchDataUsers }
}

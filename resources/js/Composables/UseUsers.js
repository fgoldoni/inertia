import { ref } from 'vue'
import pickBy from "lodash/pickBy";

export function useUsers() {

    const data = ref({
        data: null
    })

    const error = ref(false)

    const processing = ref(false)

    const doFetchData = async (params) => {
        processing.value = true

        await axios.get(route('api.users.index', pickBy(params))).then((res) => (data.value = res.data))
            .catch((err) => (error.value = err))
            .finally(() => (processing.value = false))
    }


    const doMapData = (items) => data.value.data.filter((item) => items.value.includes(item.id))

    const doGroupData = (items) => {

        return items.reduce((r, e) => {
            // get first letter of name of current element
            let group = e.name[0];
            // if there is no property in accumulator with this letter create it
            if(!r[group]) r[group] = [e]
            // if there is push current element to children array for that letter
            else r[group].push(e);
            // return accumulator
            return r;
        }, {})
    }

    return { processing, error, data , doFetchData, doGroupData, doMapData }
}

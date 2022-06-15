export default {
    fetchRoles(success, error) {
        return axios.get(route('api.roles.index')).then((response) => success(response.data), (response) => error(response));
    }
}

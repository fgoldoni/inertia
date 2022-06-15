export default {
    fetchPermissions(success, error) {
        return axios.get(route('api.permissions.index')).then((response) => success(response.data), (response) => error(response));
    }
}

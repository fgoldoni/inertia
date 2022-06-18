import columns from './columns'

export default {
    apiUrl: route('admin.users.index'),
    createUrl: route('admin.users.create'),
    perPage: 5,
    fields: columns,
}

import columns from './columns'

export default {
    title: 'Users',
    apiUrl: route('admin.users.index'),
    createUrl: route('admin.users.create'),
    deleteUri: 'admin.users.destroy',
    perPage: 5,
    fields: columns,
}

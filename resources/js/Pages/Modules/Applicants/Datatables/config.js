import columns from './columns'

export default {
    title: 'Users',
    apiUrl: route('admin.applicants.index'),
    createUrl: route('admin.applicants.create'),
    deleteUri: 'admin.applicants.destroy',
    perPage: 5,
    fields: columns,
}

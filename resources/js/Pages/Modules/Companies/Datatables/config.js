import columns from './columns'

export default {
    title: 'Companies',
    apiUrl: route('admin.companies.index'),
    createUrl: route('admin.companies.create'),
    deleteUri: 'admin.companies.destroy',
    perPage: 5,
    fields: columns,
}

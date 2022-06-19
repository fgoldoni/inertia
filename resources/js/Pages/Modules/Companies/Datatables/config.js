import columns from './columns'

export default {
    title: 'Companies',
    apiUrl: route('admin.companies.index'),
    perPage: 5,
    fields: columns,
}

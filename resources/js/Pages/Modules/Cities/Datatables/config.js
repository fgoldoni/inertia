import columns from './columns'

export default {
    title: 'Cities',
    apiUrl: route('admin.cities.index'),
    perPage: 5,
    fields: columns,
}

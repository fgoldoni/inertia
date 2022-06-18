import columns from './columns'

export default {
    title: 'Countries',
    apiUrl: route('admin.countries.index'),
    perPage: 5,
    fields: columns,
}

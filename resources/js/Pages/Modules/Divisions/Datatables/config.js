import columns from './columns'

export default {
    title: 'Divisions',
    apiUrl: route('admin.divisions.index'),
    perPage: 5,
    fields: columns,
}

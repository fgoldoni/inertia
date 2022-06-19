import columns from './columns'

export default {
    title: 'Jobs',
    apiUrl: route('admin.jobs.index'),
    perPage: 5,
    fields: columns,
}

import columns from './columns'

export default {
    title: 'Jobs',
    apiUrl: route('admin.jobs.index'),
    createUrl: route('admin.jobs.create'),
    deleteUri: 'admin.jobs.destroy',
    perPage: 5,
    fields: columns,
}

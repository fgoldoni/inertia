import columns from './columns'

export default {
    title: 'Teams',
    apiUrl: route('admin.teams.index'),
    createUrl: route('admin.teams.create'),
    deleteUri: 'admin.teams.destroy',
    perPage: 5,
    fields: columns,
}

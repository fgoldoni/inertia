import columns from './columns'

export default {
    title: 'Categories',
    apiUrl: route('admin.categories.index'),
    createUrl: route('admin.categories.create'),
    deleteUri: 'admin.categories.destroy',
    perPage: 5,
    fields: columns,
}

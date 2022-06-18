import columns from './columns'

export default {
    apiUrl: route('admin.categories.index'),
    createUrl: route('admin.categories.create'),
    perPage: 5,
    fields: columns,
}

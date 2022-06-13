export default [
    {
        name: '__checkbox',
    },
    {
        name: 'id',
        title: 'ID',
        component: false,
        sortField: 'id'
    },
    {
        name: '__component:Users/Datatables/CustomName',
        title: 'Name',
        sortField: 'name'
    },
    {
        name: '__component:Users/Datatables/CustomEmail',
        title: 'Email',
        visible: false,
        sortField: 'email'
    },
    {
        name: '__component:Users/Datatables/CustomRole',
        title: 'Role',
        visible: false
    },
    {
        name: '__component:Users/Datatables/CustomLastLogin',
        title: 'Last Login',
        visible: false
    },
    {
        name: '__component:Users/Datatables/CustomAccess',
        title: 'Access',
        visible: false
    },
    {
        name: '__component:Users/Datatables/CustomActions',
        title: '__actions',
        visible: true
    }
]

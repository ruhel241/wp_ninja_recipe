export default [
    {
        path: '/',
        name: 'ninja_recipe_home',
        component: require('./components/views/AllTables')
    },
    {
        path: '/edit_table/:table_id',
        name: 'edit_table',
        component: require('./components/views/EditTable')
    }
]
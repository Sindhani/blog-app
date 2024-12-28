const routes = [
    {
        path: '/',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '', name: 'home', component: () => import('pages/web/LandingPage.vue')

            }
        ]
    },
    {
        path: '/blogs',
        component: () => import('layouts/BlogLayout.vue'),
        children: [
            {
                path: '', name: 'blogs.index', component: () => import('pages/blogs/TheList.vue')
            },
            {
                path: ':blog/show', name: 'blogs.show', component: () => import('pages/blogs/BlogView.vue')
            },
            {
                path: 'write', name: 'blogs.create', component: () => import('pages/blogs/BlogCreate.vue')
            },
        ]
    },

    // Always leave this as last one,
    // but you can also remove it
    {
        path: '/:catchAll(.*)*',
        component: () => import('pages/ErrorNotFound.vue')
    }
]

export default routes

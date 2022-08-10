import auth from "./middlweare/auth";
import guest from "./middlweare/guest";

export const routes = {
    mode: 'history',
    routes : [
        {
            path: '/register',
            name: 'register',
            component : () => import('../pages/register'),
            meta: {
                middleware: [
                    guest
                ]
            }

        },
        {
            path: '/login',
            name: 'login',
            component : () => import('../pages/login'),
            meta: {
                middleware: [
                    guest
                ]
            }

        },
        {
            path: '/home',
            name: 'home',
            component : () => import('../pages/home'),
            meta: {
                middleware: [
                    auth
                ]
            }

        },
    ]
}


export default function auth({next}) {
    if(!localStorage.getItem('auth_token')) {
        return next({
            name: 'login'
        })
    }
    return next();
}

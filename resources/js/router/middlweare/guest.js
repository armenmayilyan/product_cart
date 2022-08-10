export default function guest({next}) {
    console.log(localStorage.getItem('auth_token'))
    if(!localStorage.getItem('auth_token')) {
        return next();
    }
    return next({
        name: 'home'
    })
}

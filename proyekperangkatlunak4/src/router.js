import HelloWorld from '@/components/HelloWorld'
import Signup from '@/components/auth/Signup'

const routes = [
    {
        path: '/',
        name: 'Helloworld',
        component: HelloWorld
    },
    {
        path: '/signup',
        name: 'Signup',
        component: Signup,
        props: true,
    },
]

export default routes
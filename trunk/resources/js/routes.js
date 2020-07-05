//import Home from './components/Home.vue';
import Welcome from './components/welcome.vue';
import ListAds from './components/Ads/listads.vue';
import Ads from './components/Ads/ads.vue';
import NewAds from './components/Ads/addads.vue';
import myAds from './components/Ads/myAds.vue';
import MainAds from './components/Ads/Main.vue';
import ProfileSet from './components/ProfileSet';
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
//import CommentForm from './components/CommentForm.vue';
import ChatApp from './components/ChatApp.vue';
import NotFound from './components/404.vue';


export const routes = [{
        path: '/',
        name: 'welcome',
        component: Welcome,
        /*pour s'assurer que le user ne parte pas dans son homepage sans s'etre authentifié*/

    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },

    {
        path: '/ads',
        component: MainAds,
        meta: {
            requiresAuth: true
        },
        children: [{
                path: '/',
                component: ListAds
            },
            {
                path: 'addads',
                component: NewAds
            },
            {
                path: 'myAds',
                component: myAds
            },
            {
                path: ':id',
                component: Ads
            }
        ]
    },

    {
        path: '/ProfileSet',
        name: 'profileset',
        component: ProfileSet,
        meta: {
            requiresAuth: true
        },

    },
    {
        path: '/ChatApp',
        name: 'ChatApp',
        component: ChatApp,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/404',
        name: 'NotFound',
        component: NotFound,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '*',
        redirect: '/404'
    }

];
/*car array ou il y aura toutes les routes dont on a besoin pour notre appli */
import Vue from 'vue'
import VueRouter from 'vue-router'

const HomeComponent = () => import("./components/Home.vue");
const WhoComponent = () => import("./components/Who.vue");
const FinalComponent = () => import("./components/Final.vue");
const FriendComponent = () => import("./components/Friend.vue");

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    hashbang: false,
    routes: [
        {name: 'home', path: '*',         component: HomeComponent },
        {name: 'who', path: '/who',         component: WhoComponent },
        {path: '/final',         component: FinalComponent },
        {path: '/forMyfriend',         component: FriendComponent }
    ]
})
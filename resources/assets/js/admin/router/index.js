//main
import Vue from 'vue';
import Router from 'vue-router'

Vue.use(Router);

//views
import {Index as MainIndex} from '@admin/views/main';
import {Index as UsersIndex} from '@admin/views/users';
import {Index as BookingIndex} from '@admin/views/booking';
import {Index as TextsIndex} from '@admin/views/texts';
import {NotFound} from '@admin/views/errors';

export default new Router({
    mode: 'history',
    history: true,
    hashbang: false,
    linkActiveClass: 'active',
    routes: [
        {
            path: '*',
            name: 'not.found',
            component: NotFound
        },
        {
            path: '/admin',
            name: 'admin.main.index',
            component: MainIndex
        },
        {
            path: '/admin/users',
            name: 'admin.users.index',
            component: UsersIndex
        },
        {
            path: '/admin/booking',
            name: 'admin.booking.index',
            component: BookingIndex
        },
        {
            path: '/admin/texts',
            name: 'admin.texts.index',
            component: TextsIndex
        },
    ]
})
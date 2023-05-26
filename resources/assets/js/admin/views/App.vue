<template>
    <div id="app">
        <vue-app-header></vue-app-header>
        <notifications group="main" />
        <div class="wrapper">
            <vue-app-menu></vue-app-menu>

            <div class="main">
                <router-view></router-view>
            </div>

            <div style="clear: both;"></div>
        </div>
    </div>
</template>

<script>
    import {VueAppHeader, VueAppMenu} from '@admin/components';

    export default {
        name: 'app',
        components: {
            VueAppHeader,
            VueAppMenu
        }
    }
</script>
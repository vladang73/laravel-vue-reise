<template>
    <!-- menu -->
    <div class="menu" id="menu">
        <ul class="menu-list">
            <template v-for="menuItem in menuItems">
                <li class="menu-list__item" @click="go(menuItem.routeName)">
                    <div class="item-head item-head-main">
                        <div class="item-head__icon">
                            <img :src="menuItem.iconUrl" alt="dashboard">
                        </div>
                        <span v-html="menuItem.title"></span>
                    </div>
                </li>
            </template>
        </ul>
    </div>
    <!-- menu end -->
</template>

<script>
    export default {
        name: "vue-app-menu",
        data() {
            return {
                menuItems: [
                    {
                        'routeName': 'admin.main.index',
                        'iconUrl': '/img/home.svg',
                        'title': 'Dashboard'
                    },
                    {
                        'routeName': 'admin.booking.index',
                        'iconUrl': '/img/calendar2.svg',
                        'title': 'Boeking'
                    },
                    {
                        'routeName': 'admin.main.index',
                        'iconUrl': '/img/taken.svg',
                        'title': 'Rooster'
                    },
                    {
                        'routeName': 'admin.users.index',
                        'iconUrl': '/img/users.svg',
                        'title': 'Gebruikers'
                    },
                    {
                        'routeName': 'admin.texts.index',
                        'iconUrl': '/img/edit.svg',
                        'title': 'Privacy texten'
                    },
                ]
            }
        },
        computed: {
            currentRoute() {
                return this.$router.currentRoute;
            }
        },
        methods: {
            go(routeName) {
                this.$router.push({name: routeName});
            }
        }
    }
</script>

<style scoped>

</style>
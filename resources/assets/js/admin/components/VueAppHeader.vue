<template>
    <!-- header -->
    <nav class="navbar navbar-expand-md fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a href="#" class="col logo">
            <img src="/img/logo-img.png" alt="logo" class="logo__img">
        </a>
        <div class="col header-wrap">
            <div class="col search">
                <!--<span class="search__icon"> </span>-->
                <!--<input class="search__input" type="search" :placeholder='$t("common.search")'>-->
            </div>
            <div class="col notify ml-auto">
                <!--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.8 81.2">-->
                    <!--<path class="svg-c-l-g" d="M27.5,68v1.8A11.39,11.39,0,0,0,38.9,81.2h0A11.39,11.39,0,0,0,50.3,69.8V68H77.8L67.4,49.7V28.5A28.55,28.55,0,0,0,38.9,0h0A28.49,28.49,0,0,0,10.4,28.5h0V49.7L0,68Zm18.8,1.8a7.38,7.38,0,0,1-7.4,7.4h0a7.38,7.38,0,0,1-7.4-7.4V68H46.3ZM14.4,28.5A24.54,24.54,0,0,1,38.9,4h0A24.54,24.54,0,0,1,63.4,28.5V50.8L71,64H6.8l7.5-13.2Z" />-->
                    <!--<path class="svg-c-l-g" d="M38.1,13.6l-.6-4A20.9,20.9,0,0,0,20.2,27.5l4,.5A16.76,16.76,0,0,1,38.1,13.6Z" />-->
                <!--</svg>-->
                <!--<div class="notify__point"></div>-->
            </div>
            <div class="col profile">
                <span class="profile__name">{{ userName }}</span>
                <div class="profile__dropdown" v-on:click="toggleProfile">
                    <img v-if="image" :src="'images/' + image" alt="profile" class="profile__img" style="height: 35px;width:35px">
                    <img v-else src="/img/profile.png" alt="profile" class="profile__img">
                    <div class="profile__arrow">
                        <svg version="1.1" class="arr-down" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125">
                            <polygon class="svg-c-d-g" points="95,50 50,95 47,92 89,50 47,8 50,5 " />
                        </svg>
                    </div>
                </div>
                <div class="profile__popup" v-show="isVisibleProfilePopup">
                    <!--<div class="profile-popup__item">-->
                        <!--<span>-->
                            <!--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 93.9 86.3">-->
                                <!--<path class="svg-c-l-g" d="M46.9 86.3c-15.7-1-31.2-3-46.2-8.2-.5-.2-.8-.8-.7-1.3 0-.2 4-17.8 18.7-19 .7-.1 1.5-.1 2.6-.1h5.4c3.2 0 7.1-.2 9.1-1.5 1.6-1.1 3.3-4.2 1-7.9-.3-.4-.7-.9-1.1-1.2-1.4-1.3-2.8-2.7-3.3-10h-.3c-.9 0-3.1-.4-3.7-3.8-.3-.9-2.1-6.8-.2-9.3.4-.6 1.1-1 1.8-1.2 0-2.4.4-8.8 2.5-12.8C34.2 3.7 39.5.1 47 0s12.8 3.8 14.4 10c2.1 3.9 2.4 10.3 2.5 12.8.7.2 1.4.6 1.8 1.2 1.9 2.6.1 8.4-.2 9.3-.6 3.4-2.8 3.8-3.7 3.8h-.3c-.5 7.2-2 8.6-3.3 10-.4.4-.8.8-1.1 1.2-2.4 3.8-.7 6.9 1 7.9 2.1 1.3 6 1.5 9.1 1.5h5.4c1.1 0 1.9 0 2.6.1C89.9 59 93.8 76.6 93.8 76.7c.1.6-.2 1.1-.7 1.4-15.1 5.2-30.3 7.2-46.2 8.2zM2.3 76.2c14.4 4.9 29.5 7.4 44.7 7.5 15.2-.1 30.3-2.6 44.7-7.5-1-3.4-5.2-15.5-16.6-16.5-.6 0-1.4-.1-2.4-.1h-5.4c-3.7 0-7.8-.2-10.3-1.8-2.3-1.5-4.7-5.7-1.6-10.7.4-.6.8-1.1 1.4-1.6 1.2-1.2 2.4-2.3 2.8-9.8.1-.5.6-.9 1.1-.9.1 0 .2 0 .3.1.2.1.5.1.8.2.3 0 1.3 0 1.7-2.2v-.1c.7-2.2 1.5-6.2.5-7.6-.2-.3-.6-.5-1-.4-.6 0-1-.4-1.1-.9v-.1c0-.1.1-8.5-2.3-12.8 0-.1-.1-.2-.1-.2-1.4-5.4-6-8.5-12.6-8.6s-11.1 3.1-12.6 8.5c0 .1-.1.2-.1.2-2.3 4.3-2.2 12.6-2.2 12.7 0 .3-.1.6-.3.8-.2.2-.5.3-.8.3h-.1c-.4-.1-.8.1-1 .4-1 1.4-.2 5.4.5 7.6v.1c.5 2.2 1.5 2.2 1.8 2.2.3 0 .5-.1.8-.2.3-.2.7-.1 1 .1.3.2.5.5.5.8.4 7.5 1.6 8.7 2.8 9.8.5.5 1 1 1.4 1.6 3.2 5 .7 9.3-1.6 10.7-2.5 1.6-6.6 1.8-10.3 1.8h-5.4c-1 0-1.8 0-2.4.1-11.4 1-15.7 13.1-16.6 16.5z" />-->
                            <!--</svg>-->
                        <!--</span>{{ $t('common.profile') }}</div>-->
                    <!--<div class="profile-popup__item"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.8 81.2">-->
                    <!--<path class="svg-c-l-g" d="M27.5,68v1.8A11.39,11.39,0,0,0,38.9,81.2h0A11.39,11.39,0,0,0,50.3,69.8V68H77.8L67.4,49.7V28.5A28.55,28.55,0,0,0,38.9,0h0A28.49,28.49,0,0,0,10.4,28.5h0V49.7L0,68Zm18.8,1.8a7.38,7.38,0,0,1-7.4,7.4h0a7.38,7.38,0,0,1-7.4-7.4V68H46.3ZM14.4,28.5A24.54,24.54,0,0,1,38.9,4h0A24.54,24.54,0,0,1,63.4,28.5V50.8L71,64H6.8l7.5-13.2Z" />-->
                    <!--<path class="svg-c-l-g" d="M38.1,13.6l-.6-4A20.9,20.9,0,0,0,20.2,27.5l4,.5A16.76,16.76,0,0,1,38.1,13.6Z" />-->
                <!--</svg></span> {{ $t('common.notifications') }}</div>-->
                    <div class="profile-popup__item" v-on:click="logout">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56 56" style="enable-background:new 0 0 56 56;" xml:space="preserve" >
                                <path class="svg-c-l-g" d="M25.293,39.293c-0.391,0.391-0.391,1.023,0,1.414C25.488,40.902,25.744,41,26,41s0.512-0.098,0.707-0.293l11.999-11.999   c0.093-0.092,0.166-0.203,0.217-0.326c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L26.707,15.293   c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L35.586,27H5c-0.553,0-1,0.447-1,1s0.447,1,1,1h30.586L25.293,39.293z" fill="#eceff1"/>
                                <path class="svg-c-l-g" d="M51,0H14c-0.553,0-1,0.447-1,1v21c0,0.553,0.447,1,1,1s1-0.447,1-1V2h35v52H15V34c0-0.553-0.447-1-1-1s-1,0.447-1,1v21   c0,0.553,0.447,1,1,1h37c0.553,0,1-0.447,1-1V1C52,0.447,51.553,0,51,0z" fill="#eceff1"/>
                            </svg>
                        </span>
                        {{ $t('common.logout') }}
                    </div>
                </div>
            </div>
            <div class="col setting">
                <!--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90" class="setting__img">-->
                    <!--<path class="svg-c-l-g" d="M90,54V36H78.3a34.64,34.64,0,0,0-3.4-8.2l8.3-8.3L70.5,6.8l-8.3,8.3A33,33,0,0,0,54,11.7V0H36V11.7a34.63,34.63,0,0,0-8.2,3.4L19.5,6.8,6.8,19.5l8.3,8.3A33,33,0,0,0,11.7,36H0V54H11.7a34.63,34.63,0,0,0,3.4,8.2L6.8,70.5,19.5,83.2l8.3-8.3A33,33,0,0,0,36,78.3V90H54V78.3a34.64,34.64,0,0,0,8.2-3.4l8.3,8.3L83.2,70.5l-8.3-8.3A33,33,0,0,0,78.3,54ZM45,63A18,18,0,1,1,63,45,18.05,18.05,0,0,1,45,63Z" />-->
                <!--</svg>-->
            </div>
        </div>
    </nav>
    <!-- header end -->
</template>

<script>
    import {
        mapGetters
    } from 'vuex';
    export default {
        name: "vue-app-header",
        data() {
            return {
                isVisibleProfilePopup: false,
            }
        },
        computed: {
            ...mapGetters({
                userName: 'auth/getUserName',
                image: 'auth/getImage'
            })
        },
        methods: {
            logout() {
                window.location.href = window.location.origin + '/auth/logout';
            },
            toggleProfile() {
                this.isVisibleProfilePopup = !this.isVisibleProfilePopup;
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div class="content">
        <h1>Privacy teksten</h1>
        <div class="content-section">
            <div class="customer-details">
                <div class="customer-form__item text-select">
                    <label for="provider-id">{{ $t('booking.provider') }}</label>
                    <v-select id="provider-id"
                              label="name"
                              :onChange="selectProvider"
                              :options="getProviders"
                              :value="selectedProvider">
                        <template slot="option" slot-scope="option">
                            {{ option.name }}
                            <span aria-hidden="true" title="Delete" style="float: right;" v-on:click.prevent="deleteHoliday(option.id)">×</span>
                        </template>
                    </v-select>
                </div>
                <div class="customer-form__item text">
                    <label>{{ $t('texts.firstTitle') }}</label>
                    <input type="text" v-model="text.first_title" class="edit-inp" />
                </div>
                <div class="customer-form__item editor">
                    <label>{{ $t('texts.firstParagraph') }}</label>
                    <vue-editor v-model="text.first_paragraph"></vue-editor>
                </div>
                <div class="customer-form__item text">
                    <label>{{ $t('texts.secondTitle') }}</label>
                    <input type="text" v-model="text.second_title" class="edit-inp" />
                </div>
                <div class="customer-form__item editor">
                    <label>{{ $t('texts.secondParagraph') }}</label>
                    <vue-editor v-model="text.second_paragraph"></vue-editor>
                </div>
                <div class="customer-form__item text">
                    <label>{{ $t('texts.thirdTitle') }}</label>
                    <input type="text" v-model="text.third_title" class="edit-inp" />
                </div>
                <div class="customer-form__item editor">
                    <label>{{ $t('texts.thirdParagraph') }}</label>
                    <vue-editor v-model="text.third_paragraph"></vue-editor>
                </div>
                <div class="customer-form__item editor">
                    <label>{{ $t('texts.footer') }}</label>
                    <vue-editor v-model="text.epilogue"></vue-editor>
                </div>
                <button type="button" class="buttons__primary" @click="save">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    import api from '@admin/api';
    import {
        mapGetters,
        mapActions
    } from 'vuex';
    import { VueEditor } from 'vue2-editor'
    import vSelect from 'vue-select';

    export default {
        data() {
            return {
                selectedProvider: {id: 1},
                text: {
                    first_title: '',
                    first_paragraph: '',
                    second_title: '',
                    second_paragraph: '',
                    third_title: '',
                    third_paragraph: '',
                    epilogue: ''
                }
            }
        },
        computed: {
            ...mapGetters({
                getTexts: 'texts/getTexts',
                getProviders: 'booking/getProviders'
            }),
        },
        watch: {
            getTexts() {
                this.text = this.getTexts[0];
                /*this.text.id = this.getTexts[0].id;
                this.text.firstTitle = this.getTexts[0].first_title;
                this.text.firstParagraph = this.getTexts[0].first_paragraph;
                this.text.secondTitle = this.getTexts[0].second_title;
                this.text.secondParagraph = this.getTexts[0].second_paragraph;
                this.text.thirdTitle = this.getTexts[0].third_title;
                this.text.thirdParagraph = this.getTexts[0].third_paragraph;
                this.text.epilogue = this.getTexts[0].epilogue;*/
            },
            getProviders() {
                this.selectedProvider = this.getProviders[0];
            }
        },
        methods: {
            ...mapActions({
                setTexts: 'texts/setTexts',
                setProviders: 'booking/setProviders'
            }),
            save() {
                let params = this.text;
                api.postRequest(api.urls.texts + '/' + params.id, params).then(res => {
                    if (res.data.success === true) {
                        this.$notify({
                            group: 'main',
                            title: 'Success!',
                            text: 'Texts saved',
                            type: 'success'
                        });
                    } else {
                        this.$notify({
                            group: 'main',
                            title: 'Error!',
                            text: res.data.message,
                            type: 'error'
                        });
                    }
                });
            },
            selectProvider(data)
            {
                if(data) {
                    this.selectedProvider = data;
                    this.setTexts(this.selectedProvider.id);
                }
            }
        },
        beforeMount() {
            this.setProviders();
            this.setTexts(this.selectedProvider.id);
        },
        components: {
            VueEditor,
            vSelect
        },
    }
</script>

<style scoped>
    .buttons__primary{
        display: flex;
        justify-content: center;
        width: 100%;
        max-width: 140px;
        height: 40px;
        color: #fff;
        background-color:#009fe3;
        font-family: "LatoRegular";
        border: none;
        border-radius: 3px;
    }
    h1 {
        padding-left: 50px;
    }
    .content-section {
        padding: 0;
    }

    .text-select {
        margin: 10px 0 10px -335px;
    }

    .text {
        margin: 10px 0 10px -300px;
    }

    .editor {
        height: 300px;
        margin-bottom: 120px;
    }
</style>
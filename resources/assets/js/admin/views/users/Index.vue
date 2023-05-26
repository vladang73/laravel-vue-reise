<template>
    <div class="content">
        <h1 class="content-title">Medewerkers</h1>
        <div class="content-filter">
            <div class="filter-amount">
                <span v-for="(size, index) in pageSizes">
                    <span class="amount-number" v-on:click="setPageSize(size)">{{ size }}</span>
                    <span class="amount-line" v-if="index !== pageSizes.length - 1"></span>
                </span>
            </div>
        </div>
        <div class="content-section">
            <div class="content-table-wrap">
                <div class="table-responsive" style="padding: 0 15px">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th nowrap scope="col">Profielfoto</th>
                                <th nowrap scope="col" v-on:click="sort('first_name')">Achternaam <span class="arr-sort"></span></th>
                                <th nowrap scope="col" v-on:click="sort('last_name')">Voornaam <span class="arr-sort"></span></th>
                                <th nowrap scope="col" v-on:click="sort('email')">Email <span class="arr-sort"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in sortedUsers"
                                v-on:mouseover="mouseOver(user.id)"
                                v-on:mouseleave="mouseLeave">
                                <td>
                                    <span class="edit"
                                        v-on:click="triggerEditModal(user)"></span>
                                    <img :src="user.image">
                                </td>
                                <td>{{ user.first_name }}</td>
                                <td>{{ user.last_name }}</td>
                                <td>
                                    <span class="del"
                                        v-on:click="triggerDeleteModal(user.id)"></span>
                                    {{ user.email }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="under-table">
            <div class="order-2 order-sm-1 add-new" @click="triggerCreateModal">
                Nieuwe medewerker
            </div>
            <div class="order-1 order-sm-2 paginator" v-if="pagesCount > 1">
                        <span class="paginator__arrow-prev" v-on:click="previousPage">
                    			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 48"><title>arrow_svg</title><polygon
                                        points="45 48 0 3 3 0 45 42 87 0 90 3 45 48"/></svg>
                    	</span>
                        <span class="paginator__number"
                              v-for="number in pagesCount"
                              v-on:click="selectPage(number)">{{ number }}</span>
                        <span class="paginator__arrow-next" v-on:click="nextPage">
                    	    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 48"><title>arrow_svg</title><polygon
                                points="45 48 0 3 3 0 45 42 87 0 90 3 45 48"/></svg>
                        </span>
            </div>
        </div>
        <modal v-if="isVisibleCreateModal">
            <div slot="header">
              <div class="popup-add__button" v-on:click="submitAddForm"></div>
              <div class="popup__close" aria-label="Close" @click="triggerCreateModal"></div>
              <div class="popup__title">Nieuwe medewerker</div>
            </div>
            <div slot="body">
                <form class="add-form" action="#" @submit.prevent="validateCreateBeforeSubmit" enctype="multipart/form-data">
                    <div class="form-row">
                        <label for="add-name">Voornaamk</label>
                        <!--:class="errors.has('first_name') ? 'is-invalid': 'edit-inp'"-->
                        <input id="add-name" type="text" name="first_name"
                               class="edit-inp"
                               data-vv-as="'first_name'"
                               v-model="userData.first_name"
                               v-validate="{required: true}" >
                    </div>
                    <div v-show="errors.has('first_name')" class="invalid-feedback">{{ errors.first('first_name') }}</div>
                    <div class="form-row">
                        <label for="add-surname">Achternaam</label>
                        <!--:class="errors.has('last_name') ? 'is-invalid': 'edit-inp'"-->
                        <input id="add-surname" type="text" name="last_name"
                               class="edit-inp"
                               data-vv-as="'last_name'"
                               v-model="userData.last_name"
                               v-validate="{required: true}">
                    </div>
                    <div v-show="errors.has('last_name')" class="invalid-feedback">{{ errors.first('last_name') }}</div>
                    <div class="form-row">
                        <label for="add-email">Email</label>
                        <!--:class="errors.has('email') ? 'is-invalid': 'edit-inp'"-->
                        <input id="add-email" type="email" name="email"
                               class="edit-inp"
                               data-vv-as="'email'"
                               v-model="userData.email"
                               v-validate="{required: true, email: true}" >
                    </div>
                    <div v-show="errors.has('email')" class="invalid-feedback">{{ errors.first('email') }}</div>
                    <div class="form-row">
                        <label for="add-password">Wachtwoord</label>
                        <!--:class="errors.has('password') ? 'is-invalid': 'edit-inp'"-->
                        <input id="add-password" type="password" name="password"
                               class="edit-inp"
                               data-vv-as="'password'"
                               v-model="userData.password"
                               v-validate="{required: true, min: 6}" >
                    </div>
                    <div v-show="errors.has('password')" class="invalid-feedback">{{ errors.first('password') }}</div>
                    <div class="form-row">
                        <label>Profielfoto</label>
                        <span class="spanInput"> {{ visibleName }} <span class="del" v-if="visibleName" v-on:click="deleteImage"></span></span>
                    </div>
                    <div v-if="!visibleName">
                        <drop-box :showInitial="showInitial"
                                v-on:file-path="setImagePath"
                                v-on:visible-name="setVisibleName"
                        ></drop-box>
                    </div>
                    <button type="submit" class="buttons__primary invisible" ref="addButton">Send</button>

                </form>
            </div>
        </modal>

        <modal v-if="isVisibleEditModal">
            <div slot="header">
                <div class="popup-edit__button" v-on:click="submitEditForm"></div>
                <div class="popup__close" aria-label="Close" @click="triggerEditModal"></div>

                <div class="popup__title">Bewerk medewerker</div>
            </div>
            <div slot="body">
                <form class="add-form" action="#" @submit.prevent="validateEditBeforeSubmit" enctype="multipart/form-data">
                    <div class="form-row">
                        <label for="edit-name">Voornaamk</label>
                        <!--:class="errors.has('first_name') ? 'is-invalid': 'edit-inp'"-->
                        <input id="edit-name" type="text" name="first_name"
                               class="edit-inp"
                               data-vv-as="'first_name'"
                               v-model="userData.first_name"
                               v-validate="{required: true}" >
                    </div>
                    <div v-show="errors.has('first_name')" class="invalid-feedback" style="display:block">{{ errors.first('first_name') }}</div>
                    <div class="form-row">
                        <label for="edit-surname">Achternaam</label>
                        <!--:class="errors.has('last_name') ? 'is-invalid': 'edit-inp'"-->
                        <input id="edit-surname" type="text" name="last_name"
                               class="edit-inp"
                               data-vv-as="'last_name'"
                               v-model="userData.last_name"
                               v-validate="{required: true}">
                    </div>
                    <div v-show="errors.has('last_name')" class="invalid-feedback" style="display:block">{{ errors.first('last_name') }}</div>
                    <div class="form-row">
                        <label for="edit-email">Email</label>
                        <!--:class="errors.has('email') ? 'is-invalid': 'edit-inp'"-->
                        <input id="edit-email" type="email" name="email"
                               class="edit-inp"
                               data-vv-as="'email'"
                               v-model="userData.email"
                               v-validate="{required: true, email: true}" >
                    </div>
                    <div v-show="errors.has('email')" class="invalid-feedback" style="display:block">{{ errors.first('email') }}</div>

                    <div class="form-row">
                        <label>Profielfoto</label>
                        <span class="spanInput">{{ visibleName }} <span class="del" v-if="visibleName" v-on:click="deleteImage"></span></span>
                    </div>
                    <div v-if="!visibleName">
                        <drop-box :showInitial="showInitial"
                                v-on:file-path="setImagePath"
                                v-on:visible-name="setVisibleName"></drop-box>
                    </div>
                    <button type="submit" class="buttons__primary invisible" ref="editButton">Send</button>
                </form>
            </div>
        </modal>

        <modal v-if="isVisibleDeleteModal" @close="triggerDeleteModal">
            <div slot="header">
                <div class="popup-del__button"></div>
            </div>
            <div slot="body">
                <form class="add-form" action="#">
                    <div class="popup-del">
                        <div class="popup__title" style="text-align: center; display: block!important;">Are you sure?</div>
                        <div class="popup-del__buttons">
                            <div class="buttons__delete" v-on:click="deleteUser">Delete</div>
                            <div class="buttons__cancel" v-on:click="triggerDeleteModal()">Afkeuren</div>
                        </div>
                    </div>
                </form>
            </div>
        </modal>
    </div>

</template>

<script>
    import {Modal, DropBox} from '@admin/components/common';
    import api from '@admin/api';
    import table from '@admin/mixins/table';
    import {mapGetters, mapActions} from 'vuex';

    export default {
        mixins: [table],
        data() {
            return {
                isVisibleCreateModal: false,
                isVisibleEditModal: false,
                isVisibleDeleteModal: false,
                userData: {
                    first_name: '',
                    last_name: '',
                    password: '',
                    email: '',
                    image: ''
                },
                overId: null,
                deleteId: null,
                visibleName: '',
                showInitial: false
            };
        },

        name: "users-index",
        computed: {
            ...mapGetters({
                list: 'users/getList'
            }),
            sortedUsers() {
                return this.list.sort((a, b) => {
                    let modifier = 1;
                    if(this.currentSortDir === 'desc') {
                        modifier = -1;
                    }
                    if(a[this.currentSort] < b[this.currentSort]) {
                        return -1 * modifier;
                    }
                    if(a[this.currentSort] > b[this.currentSort]) {
                        return modifier;
                    }

                    return 0;
                }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
            }
        },
        watch: {
            visibleName() {
                this.showInitial = this.visibleName === '';
            },
            pagesCount() {
                return [...Array(this.pagesCount).keys()].map((item) => {
                    return item++;
                });
            }
        },
        methods: {
            ...mapActions({
                setList: 'users/setList',
                deleteItem: 'users/deleteItem'
            }),
            addUser() {
                this.userData.image = this.userData.image.substring('resize/fit/30x30/images/'.length - 1);
                let params = this.userData;
                api.postRequest(api.urls.users, params).then(res => {
                    if (res.data.success === true) {
                        this.setList();
                        this.triggerCreateModal();
                        this.$notify({
                            group: 'main',
                            title: 'Success!',
                            text: 'User successfully added!',
                            type: 'success'
                        });
                    }  else {
                        this.$notify({
                            group: 'main',
                            title: 'Error!',
                            text: res.data.message,
                            type: 'error'
                        });
                    }
                });
            },
            deleteImage() {
                this.visibleName = '';
                this.userData.image = '';
            },
            deleteUser() {
                api.deleteRequest(api.urls.users + '/' + this.deleteId).then(res => {
                    if (res.data.success === true) {
                        this.setList();
                        this.triggerDeleteModal();
                        this.$notify({
                            group: 'main',
                            title: 'Success!',
                            text: 'User successfully deleted!',
                            type: 'success'
                        });
                    }  else {
                        this.$notify({
                            group: 'main',
                            title: 'Error!',
                            text: res.data.message,
                            type: 'error'
                        });
                    }
                });
            },
            editUser() {
                this.userData.image = this.userData.image.substring('resize/fit/30x30/images/'.length - 1);
                let params = this.userData;
                api.putRequest(api.urls.users + '/' + this.userData.id, params).then(res => {
                    if (res.data.success === true) {
                        this.setList();
                        this.triggerEditModal();
                        this.$notify({
                            group: 'main',
                            title: 'Success!',
                            text: 'User successfully updated!',
                            type: 'success'
                        });
                    }  else {
                        this.$notify({
                            group: 'main',
                            title: 'Error!',
                            text: res.data.message,
                            type: 'error'
                        });
                    }
                });
            },
            mouseOver(id) {
                this.overId = id;
            },
            mouseLeave()
            {
                this.overId = null;
            },
            setImagePath(data) {
                this.userData.image = 'resize/fit/30x30/images/' + data;
            },
            setVisibleName(data) {
                this.visibleName = data;
            },
            submitAddForm() {
                this.$refs.addButton.click();
            },
            submitEditForm() {
                this.$refs.editButton.click();
            },
            triggerCreateModal() {
                this.visibleName = '';
                this.isVisibleCreateModal = !this.isVisibleCreateModal;
            },
            triggerEditModal(user = null) {
                if(user) {
                    this.userData = user;
                    this.visibleName = user.image;
                } else {
                    this.userData = {
                        first_name: '',
                            last_name: '',
                            password: '',
                            email: '',
                            image: ''
                    };
                    this.visibleName = '';
                }
                this.isVisibleEditModal = !this.isVisibleEditModal;
            },
            triggerDeleteModal(id = null) {
                this.deleteId = id;
                this.isVisibleDeleteModal = !this.isVisibleDeleteModal;
            },
            validateCreateBeforeSubmit() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        this.addUser();
                        return;
                    }
                });
            },
            validateEditBeforeSubmit() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        this.editUser();
                        return;
                    }
                });
            },
        },
        beforeMount() {
            this.setList();
            this.pagesCount = Math.ceil(this.list.length / this.pageSize);
        },
        mounted() {

        },
        components: {
            Modal,
            DropBox
        }
    }
</script>

<style scoped>

</style>

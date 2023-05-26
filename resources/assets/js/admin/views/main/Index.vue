<template>
        <div class="content  ">
            <h1 class="content-title">Scheduling tool</h1>
            <div class="content-filter">
                <div class="filter-wrap">
                    <div class=" filter-week">
                        <span class="filter-title">Choose time-zone</span>
                        <div class="filter-week-wrap">
                            <div class="arr-left" style="width: 15px; height: 15px;" v-on:click="subWeek">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                    <g>
                                        <path class="cls-1"
                                              d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="date-wrap"><img src="/img/calendar2-black.svg" alt=""
                                                        style="width: 15px; height: 15px;">
                                <span class="week">Week {{ currentWeekNumber }}</span>
                                <span>
                                    Maandag {{ startDate }} <span
                                        v-if="startMonth !== endMonth">{{ startMonth }}</span>- Zondag {{ endDate }}, {{ endMonth }}
                                </span>
                            </div>
                            <div class="arr-right" style="width: 15px; height: 15px;" v-on:click="addWeek">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                    <g>
                                        <path class="cls-1"
                                              d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class=" filter-city">
                        <span class="filter-title">{{ $t('main.selectCity') }}</span>
                        <v-select :options="citiesFilter" label="name" :placeholder="$t('main.selectCity')" :resetOnOptionsChange="true"
                                  v-model="cityFilter">
                            <template slot="option" slot-scope="option">
                                {{ option.name }}
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="filter-amount filter-amount--dn">
                    <span class="amount-number">10</span>
                    <span class="amount-line"></span>
                    <span class="amount-number">25</span>
                    <span class="amount-line"></span>
                    <span class="amount-number">50</span>
                    <span class="amount-line"></span>
                    <span class="amount-number">100</span>
                </div>
            </div>
            <div class="content-section content-section--calendar">
                <div class="content-table-wrap">
                    <div class="table-responsive" style="padding: 0 15px">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th nowrap width="250px" scope="col">
                                    <div class="search-filter">
                                        <v-select :options="nameFilter" label="name"
                                                  :placeholder="$t('main.selectFilter')" :resetOnOptionsChange="true"
                                                  v-model="filterName">
                                            <template slot="option" slot-scope="option">
                                                {{ option.name }}
                                            </template>
                                        </v-select>
                                        <input type="text" v-model="filterText" placeholder="Filter by name">
                                    </div>
                                </th>
                                <th nowrap width="204px" scope="col" v-for="day in days">{{ day.dayName }}, {{ day.number }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- ///////////////////////////////////////////////////////////////  -->
                            <tr v-for="item in schedule">
                                <td>
                                    <div class="worker-wrap">
                                        <div class="worker__img">
                                            <img :src="item.user.image" alt="" v-if="item.user.image">
                                            <img src="/img/icon_username.png" v-else>
                                        </div>
                                        <div class="worker__text">
                                            <span>{{ item.user.first_name }} {{ item.user.last_name }}</span>
                                            <!--<span class="worker__text-hours">50 hrs / week</span>-->
                                        </div>
                                    </div>
                                </td>
                                <td v-for="day in item.scheduling" :colspan="day.colspan">
                                    <div class="cell-wrap" :class="day.color.name" v-if="day.title !== '0' && day.show">
                                         <span class="edit"
                                               style="right: 50px; left: auto !important;"
                                               v-on:click="showEdit(item.user.id, day)"></span>
                                        <!--<div class="cell-active">
                                            <div class="cell-active__popup">
                                                Mate is in another city
                                                <div class="triangle"></div>
                                            </div>
                                        </div>-->
                                        <span class="task">{{ day.title }}</span>
                                        <div class="time">
                                            <img src="/img/table-icon/clock.svg" alt="">
                                            {{ day.hoursStart }} - {{ day.hoursEnd }}
                                        </div>
                                    </div>
                                    <div class="cell-wrap free new-task" v-on:click="showAdd(item.user.id, day)" v-else>
                                        <span class="task">Add new task</span>
                                        <div class="time"><span class="add-new--grey"></span></div>
                                    </div>
                                </td>

                            </tr>
                            <!-- ///////////////////////////////////////////////////////////////  -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="under-table">
                <div class="order-2 order-sm-1">

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
                    <div class="popup-add__button" v-if="!newScheduling.id" v-on:click="submitAddForm"></div>
                    <div class="popup-edit__button" v-else v-on:click="submitAddForm"></div>
                    <div class="popup__close" aria-label="Close" @click="triggerCreateModal"></div>
                    <div class="form-head-wrap">
                      <div class="popup__title" v-if="!newScheduling.id">Nieuwe taak toevoegen voor</div>
                        <div class="popup__title" v-else >Taak</div>
                      <div class="selected-people">
                          <img :src="selectedUser.image" alt="" v-if="selectedUser.image">
                          <img src="/img/icon_username.png" alt="" v-else>
                          <span class="selected-people__name">{{ selectedUser.first_name }} {{ selectedUser.last_name }}</span>
                      </div>
                    </div>

                </div>
                <div slot="body">

                    <form class="add-form" action="#" @submit.prevent="validateCreateBeforeSubmit" enctype="multipart/form-data">
                        <div class="form-row">
                            <label for="add-task-name">Taak</label>
                            <input class="add-inp" id="add-task-name" type="text" data-vv-as="'title'"
                                   v-model="newScheduling.title"
                                   v-validate="{required: true, alpha: true}">
                        </div>
                        <div v-show="errors.has('title')" class="invalid-feedback">{{ errors.first('title') }}</div>
                        <div class="form-row">
                            <label for="select-color">Selecteer kleur</label>
                            <div class="value-wrap">
                                <div :class="selectedColor" class="jq-selectbox jqselect color-item dropdown opened"
                                     id="select-color-styler" style="z-index: 10;">
                                    <select class="" name="select-color" id="select-color" data-placeholder=""
                                            v-model="newScheduling.color_id"
                                            v-show="!showAllColors"
                                            v-on:click="triggerSelectColor">
                                        <option :class="color.name"
                                                class="color-item"
                                                :value="color.name"
                                                v-for="color in colors"
                                                :selected="newScheduling.color_id === color.id"></option>
                                    </select>
                                    <div class="jq-selectbox__select">
                                        <div class="jq-selectbox__select-text placeholder" style="width: 10px;"></div>
                                        <!-- <div class="jq-selectbox__trigger">
                                            <div class="jq-selectbox__trigger-arrow"></div>
                                        </div> -->
                                    </div>
                                    <div class="jq-selectbox__dropdown" style="width: 30px; left: 0px; top: 0px; height: auto; bottom: auto;" v-show="showAllColors">
                                        <ul style="max-height: 180px; margin-top: 15px;">
                                            <li class="sel color-item" :class="color.name" v-for="color in colors" v-on:click="selectColor(color)"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Selecteer starttijd</label>
                            <date-picker v-model="startDateVisible" />
                        </div>
                        <div class="form-row">
                            <label>Selecteer het einde van de tijd</label>
                            <date-picker v-model="endDateVisible" />
                        </div>
                        <div class="form-row">
                            <label for="form__select-city">Select city</label>
                            <div class="value-wrap">
                                <v-select :options="cities" label="name" id="form__select-city"
                                          :placeholder="$t('main.selectCity')" v-model="newScheduling.city_id">
                                    <template slot="option" slot-scope="option">
                                        {{ option.name }}
                                    </template>
                                </v-select>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="form__select-city">
                                <input type="checkbox" v-model="newScheduling.is_default"/>
                                {{ $t('main.makeDefault')}}
                            </label>
                        </div>
                        <button type="submit" class="buttons__primary invisible" ref="addButton">Send</button>
                    </form>
                    <button v-if="newScheduling.id" class="btn btn-danger" style="float: right;" @click="removeScheduling()">Remove</button>
                </div>
            </modal>
        </div>
</template>

<script>
    import {Modal, DatePicker} from '@admin/components/common';
    import api from '@admin/api';
    import table from '@admin/mixins/table';
    import moment from 'moment'
    import {mapGetters, mapActions} from 'vuex';
    import vSelect from 'vue-select';

    export default {
        name: "main-index",
        mixins: [table],
        data() {
            return {
                currentWeekNumber: moment().isoWeek(),
                currentDate: moment(),
                isVisibleCreateModal: false,
                filterName: 'firstName',
                filterText: '',
                selectedUser: {},
                newScheduling: {
                    title: '',
                    color_id: '',
                    start_date: 0,
                    end_date: 0,
                    city_id: 0,
                    is_default: false
                },
                startDateVisible: '',
                endDateVisible: '',
                cityFilter: null,
                showAllColors: false,
                nameFilter: [
                    {id: 0 ,name: this.$t('main.firstName')},
                    {id: 1, name: this.$t('main.lastName')}
                ],
                selectedColor: 'ocean',
                citiesFilter: [{id: -1, name: 'All'}]
            };
        },
        watch: {
            startDateVisible() {
                this.newScheduling.start_date = moment(this.startDateVisible).unix();
            },
            endDateVisible() {
                this.newScheduling.end_date = moment(this.endDateVisible).unix();
            },
            pagesCount() {
                return [...Array(this.pagesCount).keys()].map((item) => {
                    return item++;
                });
            },
            cities(values) {
                values.forEach((item) => {
                    this.citiesFilter.push(item);
                });
            }
        },
        computed: {
            ...mapGetters({
                list: 'users/getList',
                colors: 'scheduling/getColors',
                cities: 'scheduling/getCities',
                scheduling: 'scheduling/getScheduling'
            }),
            sortedUsers() {
                return this.list.sort((a, b) => {
                    let modifier = 1;
                    if(a[this.currentSort] < b[this.currentSort]) {
                        return -1 * modifier;
                    }
                    if(a[this.currentSort] > b[this.currentSort]) {
                        return modifier;
                    }

                    return 0;
                    })
                    .filter((row) => {
                        if(this.filterText !== '') {
                            if(this.filterName && this.filterName.id === 0) {
                                return row.first_name.indexOf(this.filterText) >= 0;
                            } else {
                                return row.last_name.indexOf(this.filterText) >= 0;
                            }
                        }
                        return true;
                    })
                    .filter((row, index) => {
                        let start = (this.currentPage-1)*this.pageSize;
                        let end = this.currentPage*this.pageSize;
                        if(index >= start && index < end) return true;
                    });
            },
            schedule() {
                let scheduling = [];
                /**
                 * link scheduling with users
                 */
                this.sortedUsers.forEach((item, i) => {
                    scheduling[i] = [];
                    scheduling[i]['user'] = item;
                    scheduling[i]['scheduling'] = [];
                    for (let key in this.scheduling.data) {
                        let _item = this.scheduling.data;
                        if(_item.hasOwnProperty(key) && _item[key].user.id === item.id) {
                            _item[key].show = true;
                            scheduling[i]['scheduling'].push(_item[key]);
                        }
                    }
                });
                for(let i = 0; i < 7; i++) {
                    scheduling.forEach((item, j) => {
                        let isset = item['scheduling'].find((element) => {
                            return moment(element.start_date).format('DD') === this.days[i].number;
                        });
                        if(!isset) {
                            let clone = this.currentDate.clone();
                            item['scheduling'].push({
                                title: '0',
                                start_date:  clone.format('YYYY-') + this.days[i].month + '-' + this.days[i].number + ' 00:01:00'
                            });
                        }
                    });
                }
                /**
                 * sort scheduling by date
                 */
                scheduling.forEach((item) => {
                    item.scheduling.sort((a, b) => {
                        a.hoursStart = moment(a.start_date, 'YYYY-MM-DD HH:mm:ss').format('HH.mm');
                        a.hoursEnd = moment(a.end_date, 'YYYY-MM-DD HH:mm:ss').format('HH.mm');
                        b.hoursStart = moment(b.start_date, 'YYYY-MM-DD HH:mm:ss').format('HH.mm');
                        b.hoursEnd = moment(b.end_date, 'YYYY-MM-DD HH:mm:ss').format('HH.mm');
                        let first = moment(a.start_date, 'YYYY-MM-DD HH:mm:ss').unix();
                        let second = moment(b.start_date, 'YYYY-MM-DD HH:mm:ss').unix();
                        if(first < second) {
                            return -1;
                        } else {
                            return 1;
                        }
                    });
                    /**
                     * find the same parts (for table colspans)
                     */
                    let _scheduling = item.scheduling;
                    let length = _scheduling.length;
                    for (let i = 0; i < length; i++) {
                        if(_scheduling.hasOwnProperty(i)) {
                            if(_scheduling[i].colspan !== 0) {
                                _scheduling[i].colspan = this.theSame(_scheduling, i);
                            }
                        }
                    }
                });


                if(this.cityFilter) {
                    scheduling.forEach((schedule) => {
                        schedule['scheduling'].forEach((item) => {
                            if(item.city_id && this.cityFilter.id !== item.city_id.id){
                                item.show = false;
                            }else{
                                item.show = true;
                            }
                        });
                    });
                }
                if(this.cityFilter && this.cityFilter.id === -1){
                    scheduling.forEach((schedule) => {
                        schedule['scheduling'].forEach((item) => {
                            item.show = true;
                        });
                    });
                }

                return scheduling;

            },
            startDate() {
                return moment(this.currentDate).startOf('isoWeek').format('DD');
            },
            startMonth() {
                return moment(this.currentDate).startOf('isoWeek').format('MMM');
            },
            endDate() {
                return moment(this.currentDate).endOf('isoWeek').format('DD');
            },
            endMonth() {
                return moment(this.currentDate).endOf('isoWeek').format('MMM');
            },
            days() {
                let daysNames = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
                let days = {};
                for (let i = 0; i < 7; i++) {
                    days[i] = {};
                    let clone = moment(this.currentDate).startOf('isoWeek').clone();
                    days[i]['number'] = clone.add(i, 'day').format('DD');
                    days[i]['month'] = clone.format('MM');
                    days[i]['dayName'] = daysNames[i];
                }
                return days;
            }
        },
        methods: {
            ...mapActions({
                setList: 'users/setList',
                setColors: 'scheduling/setColors',
                setCities: 'scheduling/setCities',
                setScheduling: 'scheduling/setScheduling'
            }),
            addWeek() {
                this.currentWeekNumber +=1;
                this.currentDate = this.currentDate.clone().add(1, 'week');
                this.getData();
            },
            removeScheduling() {
                if (confirm('Are you sure?')) {
                    api.deleteRequest(api.urls.scheduling + '/' + this.newScheduling.id).then(res => {
                        if (res.data.success === true) {
                            this.getData();
                            this.triggerCreateModal();
                            this.$notify({
                                group: 'main',
                                title: 'Success!',
                                text: 'Task successfully removed!',
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
                }
            },
            addScheduling() {
                let params = this.newScheduling;
                params.city_id = params.city_id.id;
                params.user_id = this.selectedUser.id;
                if(!params.color_id) {
                    params.color_id = this.colors[0].id;
                }
                if(!this.newScheduling.id) {
                    api.postRequest(api.urls.scheduling, params).then(res => {
                        if (res.data.success === true) {
                            this.getData();
                            this.triggerCreateModal();
                            this.$notify({
                                group: 'main',
                                title: 'Success!',
                                text: 'Task successfully added!',
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
                } else {
                    api.putRequest(api.urls.scheduling + '/' + this.newScheduling.id, params).then(res => {
                        if (res.data.success === true) {
                            this.getData();
                            this.triggerCreateModal();
                            this.$notify({
                                group: 'main',
                                title: 'Success!',
                                text: 'Task successfully updated!',
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
                }
            },
            getData() {
                this.setScheduling({
                    year: this.currentDate.clone().format('YYYY'),
                    week: this.currentWeekNumber
                });
            },
            showAdd(userId, day) {
                this.newScheduling = {
                    title: '',
                    color_id: '',
                    start_date: 0,
                    end_date: 0,
                    city_id: 0,
                    is_default: false
                };
                this.startDateVisible = moment(day.start_date).format('DD MMM YYYY HH:mm');
                this.endDateVisible = moment(day.start_date).format('DD MMM YYYY HH:mm');
                this.selectedUser = this.list.filter(row => {return row.id === userId})[0];
                this.triggerCreateModal();
            },
            showEdit(userId, day) {
                this.newScheduling = JSON.parse(JSON.stringify(day));
                this.newScheduling.color_id = day.color.id;
                this.selectedColor = day.color.name;
                this.startDateVisible = moment(this.newScheduling.start_date).format('DD MMM YYYY HH:mm');
                this.endDateVisible = moment(this.newScheduling.end_date).format('DD MMM YYYY HH:mm');
                this.selectedUser = this.list.filter(row => {return row.id === userId})[0];
                this.triggerCreateModal();
            },
            selectColor(color) {
                this.newScheduling.color_id = color.id;
                this.selectedColor = color.name;
                this.triggerSelectColor();
            },
            triggerSelectColor() {
                this.showAllColors = !this.showAllColors;
            },
            submitAddForm() {
                this.$refs.addButton.click();
            },
            subWeek() {
                this.currentWeekNumber -=1;
                this.currentDate = this.currentDate.clone().subtract(1, 'week');
                this.getData();
            },
            triggerCreateModal() {
                this.isVisibleCreateModal = !this.isVisibleCreateModal;
            },
            theSame(list, iteration) {
                let length = list.length;
                let colspan = 1;
                for(let i = iteration; i < length; i++) {
                    if(list.hasOwnProperty(i+1)) {
                        if(list[i].title === list[i+1]) {
                            colspan++;
                            list[i+1].colspan = 0;
                        }
                    }
                }
                return colspan;
            },
            validateCreateBeforeSubmit()
            {
                this.addScheduling();
            }
        },
        beforeMount() {
            this.setList();
            this.setScheduling();
            this.setColors();
            this.setCities();
            this.pagesCount = Math.ceil(this.list.length / this.pageSize);
        },
        mounted() {

        },
        components: {
            Modal,
            DatePicker,
            vSelect
        }
    }
</script>

<style scoped>

</style>

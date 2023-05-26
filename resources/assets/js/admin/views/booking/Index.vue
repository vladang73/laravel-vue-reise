<template>
<!--<div class="main">-->
<div class="content  ">
  <h1 class="content-title">{{ $t('booking.title') }}</h1>
  <div class="steps">
    <div :class="[{'active': activeHeader === 1}, 'steps__item step1']">1. {{ $t('booking.selectHoliday') }}</div>
    <div :class="[{'active': activeHeader === 2}, 'steps__item step2']">2. {{ $t('booking.chooseAgency') }}</div>
    <div :class="[{'active': activeHeader === 3}, 'steps__item step3']">3. {{ $t('booking.customerDetails')}}</div>
  </div>

  <div class="content-section">
    <div :class="[{'panel-open': showFirstSection}, 'content-section__title']" v-on:click="setActiveSlide(1)">
      <div class="title__arrow">
        <svg version="1.1" class="arr-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125">
                            <polygon class="svg-c-d-g" points="95,50 50,95 47,92 89,50 47,8 50,5 "/>
                        </svg>
      </div>
      {{ $t('booking.selectHoliday') }}
    </div>
    <transition name="fade">
      <div class="content-section__info" v-if="showFirstSection">
        <div style="display: inline-block; width:50%; float: left;">
          <v-select :options="holidays" label="name" :placeholder="$t('booking.selectHoliday')" :onChange="selectHolidayType" :resetOnOptionsChange="true">
            <template slot="option" slot-scope="option">
              {{ option.name }}
              <span aria-hidden="true" title="Delete" style="float: right;" v-on:click.prevent="deleteHoliday(option.id)">×</span>
              <span aria-hidden="true" title="Edit" style="float: right; margin:3px 10px;"
                    v-on:click="triggerEditHolidayModal(option)"
                    v-if="option.name !== 'Pakketreis'">
                <img src="/img/edit.png"/>
              </span>
            </template>
          </v-select>
          <div class="add-new" id="add-type" v-on:click="triggerAddNewHolidayType">{{ $t('booking.addType') }}</div>
          <v-select :options="pakketreis" label="name"
                    :onChange="selectHolidayType"
                    :value="pakketreis[0]"
                    v-if="selectedHoliday === 4 || selectedHoliday === 5">
            <template slot="option" slot-scope="option">
              {{ option.name }}
              <span aria-hidden="true" title="Delete" style="float: right;" v-on:click.prevent="deleteHoliday(option.id)">×</span>
              <span aria-hidden="true" title="Edit" style="float: right; margin:3px 10px;"
                    v-on:click="triggerEditHolidayModal(option)">
                <img src="/img/edit.png"/>
              </span>
            </template>
          </v-select>
        </div>

        <div style="display: inline-block; width:50%; float: left; padding-left: 10px;">
          {{ explanation }}
        </div>
        <div class="clearfix"></div>
      </div>
    </transition>
  </div>


  <div class="content-section">
    <div :class="[{'panel-open': showSecondSection}, 'content-section__title']" v-on:click="setActiveSlide(2)">
      <div class="title__arrow">
        <svg version="1.1" class="arr-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125">
                            <polygon class="svg-c-d-g" points="95,50 50,95 47,92 89,50 47,8 50,5 "/>
                        </svg>
      </div>
      {{ $t('booking.chooseAgency') }}
    </div>
    <transition name="fade">
      <div class="content-section__info" v-if="showSecondSection">
        <!--:resetOnOptionsChange="true"-->
        <v-select multiple :options="agencies"
                  label="name" :placeholder="$t('booking.chooseAgency')"
                  :onChange="selectAgency"
                  >
          <template slot="option" slot-scope="option">
                                {{ option.name }}
            <span aria-hidden="true" title="Delete" style="float: right;" v-on:click.prevent="deleteAgency(option.id)">×</span>
            <span aria-hidden="true" title="Edit" style="float: right; margin:3px 10px;" v-on:click="triggerEditAgencyModal(option)">
              <img src="/img/edit.png"/>
            </span>
          </template>
        </v-select>
        <div class="agency-files">
          <div class="agency-files-wrap" v-for="section in agencyDocuments">
            <a :href="document.url" target="_blank" download class="agency-files__file-link" v-for="document in section">{{ document.name }}</a>
          </div>
        </div>
        <div class="add-new" id="add-agency" v-on:click="triggerAddNewTravelAgency">{{ $t('booking.addAgency') }}</div>
      </div>
    </transition>
  </div>


  <div class="content-section">
    <div :class="[{'panel-open': showThirdSection}, 'content-section__title']" v-on:click="setActiveSlide(3)">
      <div class="title__arrow">
        <svg version="1.1" class="arr-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125">
                            <polygon class="svg-c-d-g" points="95,50 50,95 47,92 89,50 47,8 50,5 "/>
                        </svg>
      </div>
      {{ $t('booking.customerDetails') }}
    </div>
    <transition name="fade">
      <div class="content-section__info" v-if="showThirdSection">
        <div class="customer-details">
          <form id="customer-form" action="#" @submit.prevent="validateBookingBeforeSend">
            <div class="customer-form__item">
              <label for="name">{{ $t('users.lastName') }}</label>
              <input class="edit-inp" id="name" type="text" name="last_name" v-validate="{required: true}" data-vv-as="'last_name'" v-model="customer.last_name">
            </div>
            <div v-show="errors.has('name')" class="invalid-feedback">{{ errors.first('name') }}</div>
            <div class="customer-form__item">
              <label for="email">Email</label>
              <input class="edit-inp" id="email" type="text" name="email" v-validate="{required: true, email: true}" data-vv-as="'email'" v-model="customer.email">
            </div>
            <div v-show="errors.has('email')" class="invalid-feedback">{{ errors.first('email') }}</div>
            <div class="customer-form__item">
              <label for="gender">{{ $t('booking.gender') }}</label>
              <!--:resetOnOptionsChange="true"-->
              <v-select id="gender"
                        label="name"
                        :options="genders"
                        :placeholder="$t('booking.selectGender')"
                        :onChange="selectGender"

              >
                <template slot="option" slot-scope="option">
                  {{ option.name }}
                </template>
              </v-select>
            </div>
            <div class="customer-form__item">
              <label for="provider">{{ $t('booking.provider') }}</label>
              <!--:resetOnOptionsChange="true"-->
              <v-select id="provider"
                        label="name"
                        :value="defaultProvider"
                        :options="providers"
                        :placeholder="$t('booking.selectProvider')"
                        :onChange="selectProvider"

                        >
                <template slot="option" slot-scope="option">
                                            {{ option.name }}
                                        </template>
              </v-select>
            </div>
            <div class="customer-form__item" v-if="selectedProvider === defaultProvider.id">
              <label for="location">{{ $t('booking.locationCustomer') }}</label>
              <!--:resetOnOptionsChange="true"-->
              <v-select id="location"
                        label="name"
                        :options="locations"
                        :placeholder="$t('booking.selectLocation')"
                        :onChange="selectLocation"

              >
                <template slot="option" slot-scope="option">
                  {{ option.name }}
                </template>
              </v-select>
            </div>
            <div class="customer-form__item">
              <label>
                <input type="checkbox" v-model="customer.own_conditions_apply"/>
                {{ $t('booking.ownConditions') }}
              </label>
            </div>
            <div class="customer-form__item">
              <label>
                <input type="checkbox" v-model="customer.anvr_conditions_apply"/>
                {{ $t('booking.anvrConditions') }}
              </label>
            </div>
            <button type="submit" class="buttons__primary" style="margin-top: 10px;">Save</button>
          </form>
        </div>
      </div>
    </transition>
  </div>

  <modal v-if="isVisibleNewHolidayType">
    <div slot="header">
      <div class="popup-add__button" v-on:click="submitHolidayForm"></div>
      <div class="popup__close" aria-label="Close" @click="triggerAddNewHolidayType"></div>
      <div class="popup__title">{{ $t('booking.addType') }}</div>
    </div>
    <div slot="body">
      <form class="add-form" action="#" @submit.prevent="validateAddHolidayBeforeSubmit">
        <div class="form-row">
          <label>{{ $t('booking.holidayType') }}</label>
          <input type="text" name="holidayType" class="edit-inp" data-vv-as="'holidayType'" v-model="newHoliday.type" v-validate="{required: true}">
        </div>
        <div v-show="errors.has('holidayType')" class="invalid-feedback">{{ errors.first('holidayType') }}</div>
        <div class="form-row">
          <label>URL</label>
          <input type="url" name="url" class="edit-inp" v-model="newHoliday.url">
        </div>
        <div class="form-row">
          <label>{{ $t('booking.explanation') }}</label>
          <textarea cols="41" rows="5" v-model="newHoliday.explanation"></textarea>
        </div>
        <button type="submit" class="invisible" ref="holidayButton">Submit</button>
      </form>
    </div>
  </modal>

  <modal v-if="isVisibleNewTravelAgency">
    <div slot="header">
      <div class="popup-add__button" v-on:click="submitAgencyForm"></div>
      <div class="popup__close" aria-label="Close" @click="triggerAddNewTravelAgency"></div>
      <div class="popup__title">{{ $t('booking.addAgency')}} </div>

    </div>
    <div slot="body">
      <form class="add-form" action="#" @submit.prevent="validateAddTravelAgencyBeforeSubmit">
        <div class="form-row">
          <label>{{ $t('booking.name')}}</label>
          <input id="add-name" type="text" name="name" class="edit-inp" data-vv-as="'name'" v-model="newTravelAgency.name" v-validate="{required: true}">
        </div>
        <div v-show="errors.has('name')" class="invalid-feedback">{{ errors.first('name') }}</div>
        <hr>
        <div v-for="(item,number) in documents">
          <div class="form-row">
            <button type="button" class="btn btn-danger" style="float: right" v-on:click="removeDocument(number)">Delete</button>
          </div>
          <div class="form-row">
            <label for="add-document-name">{{ $t('booking.documentTitle') }}</label>
            <input id="add-document-name" type="text" required name="documentName" class="edit-inp" v-model="newTravelAgency.documents[number].name">
            <!-- <label for="add-document-name">{{ $t('booking.url') }}</label>
            <input id="add-document-url" type="url" required name="documentUrl" class="edit-inp" v-model="newTravelAgency.documents[number].url"> -->
          </div>
          <div class="form-row">
            <label for="add-document-name">{{ $t('booking.url') }}</label>
            <input id="add-document-url" type="url" required name="documentUrl" class="edit-inp" v-model="newTravelAgency.documents[number].url">
          </div>
          <hr>
        </div>

        <button type="button" class="buttons__primary" v-on:click="addDocument">{{ $t('booking.addDocument') }}</button>
        <button type="submit" class="invisible" ref="agencyButton">Submit</button>
      </form>
    </div>
  </modal>

  <modal v-if="isVisibleEditHoliday">
    <div slot="header">
      <div class="popup-edit__button" v-on:click="editHolidayForm"></div>
      <div class="popup__close" aria-label="Close" @click="triggerEditHolidayModal(null)"></div>
      <div class="popup__title">{{ $t('booking.editType') }}</div>
    </div>
    <div slot="body">
      <form class="add-form" action="#" @submit.prevent="validateEditHolidayBeforeSubmit">
        <div class="form-row">
          <label>{{ $t('booking.holidayType') }}</label>
          <input type="text" name="holidayType" class="edit-inp" data-vv-as="'holidayType'" v-model="editHoliday.name" v-validate="{required: true}">
        </div>
        <div v-show="errors.has('holidayType')" class="invalid-feedback">{{ errors.first('holidayType') }}</div>
        <div class="form-row">
          <label>URL</label>
          <input type="url" name="url" class="edit-inp" v-model="editHoliday.url">
        </div>
        <div class="form-row">
          <label>{{ $t('booking.explanation') }}</label>
          <textarea cols="41" rows="5" v-model="editHoliday.explanation"></textarea>
        </div>
        <button type="submit" class="invisible" ref="editHolidayButton">Submit</button>
      </form>
    </div>
  </modal>

  <modal v-if="isVisibleEditAgency">
    <div slot="header">
      <div class="popup-edit__button" v-on:click="submitEditAgencyForm"></div>
      <div class="popup__close" aria-label="Close" @click="triggerEditAgencyModal(null)"></div>
      <div class="popup__title">{{ $t('booking.editAgency')}} </div>

    </div>
    <div slot="body">
      <form class="add-form" action="#" @submit.prevent="validateEditAgencyBeforeSubmit">
        <div class="form-row">
          <label>{{ $t('booking.name')}}</label>
          <input id="edit-name" type="text" name="name" class="edit-inp" data-vv-as="'name'" v-model="editAgency.name" v-validate="{required: true}">
        </div>
        <div v-show="errors.has('name')" class="invalid-feedback">{{ errors.first('name') }}</div>

        <div v-for="(item,number) in editDocuments">
          <div class="form-row">
            <button type="button" class="btn btn-danger" style="float: right" v-on:click="removeEditDocument(number)">Delete</button>
          </div>
          <div class="form-row">
            <label for="edit-document-name">{{ $t('booking.documentTitle') }}</label>
            <input id="edit-document-name" type="text" required name="documentName" class="edit-inp" v-model="editAgency.documents[number].name">
            <!-- <label for="add-document-name">{{ $t('booking.url') }}</label>
            <input id="add-document-url" type="url" required name="documentUrl" class="edit-inp" v-model="newTravelAgency.documents[number].url"> -->
          </div>
          <div class="form-row">
            <label for="edit-document-name">{{ $t('booking.url') }}</label>
            <input id="edit-document-url" type="url" required name="documentUrl" class="edit-inp" v-model="editAgency.documents[number].url">
          </div>
          <hr>
        </div>

        <!--<div class="form-row" v-for="(item,number) in editDocuments">-->
          <!--<label for="edit-document-name">{{ $t('booking.documentTitle') }}</label>-->
          <!--<input id="edit-document-name" type="text" name="documentName" class="edit-inp" v-model="editAgency.documents[number].name">-->
        <!--</div>-->
        <!--<div class="form-row" v-for="(item,number) in editDocuments">-->
          <!--<label for="edit-document-name">{{ $t('booking.url') }}</label>-->
          <!--<input id="edit-document-url" type="url" name="documentUrl" class="edit-inp" v-model="editAgency.documents[number].url">-->
        <!--</div>-->

        <button type="button" class="buttons__primary" v-on:click="addEditDocument">{{ $t('booking.addDocument') }}</button>
        <button type="submit" class="invisible" ref="agencyEditButton">Submit</button>
      </form>
    </div>
  </modal>
</div>
<!--</div>-->
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.v-select {
  width: 100%;
  max-width: 385px;
}

.v-select .dropdown-menu {
  overflow: hidden;
}
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
.dropdown .checkbox {
  border-radius: 3px;
  vertical-align: -4px;
  width: 20px;
  height: 16px;
  margin: 0 4px 0 4px;
  border: 1px solid #C3C3C3;
  background: linear-gradient(#FFF, #E6E6E6);
  box-shadow: 0 1px 1px rgba(0, 0, 0, .05), inset -1px -1px #FFF, inset 1px -1px #FFF;
  cursor: pointer;
}
.selected-tag {
  z-index: 99;
}
</style>

<script>
import {
  Modal
} from '@admin/components/common';
import api from '@admin/api';
import {
  mapGetters,
  mapActions
} from 'vuex';
import vSelect from 'vue-select';
import {
  mask
} from 'vue-the-mask';

export default {
  directives: {
    mask
  },
  data() {
    return {
      showFirstSection: true,
      showSecondSection: false,
      showThirdSection: false,
      activeHeader: 0,
      selectedHoliday: null,
      newHoliday: {
          type: '',
          url: '',
          explanation: ''
      },
      selectedProvider: null,
      isVisibleNewHolidayType: false,
      isVisibleNewTravelAgency: false,
      isVisibleEditHoliday: false,
      isVisibleEditAgency: false,
      selectedAgencies: null,
      i: 0,
      newTravelAgency: {
        name: '',
        documents: [{
          name: '',
          url: ''
        }]
      },
      customer: {
        last_name: '',
        gender_id: '',
        email: '',
        location_id: '',
        own_conditions_apply: true,
        anvr_conditions_apply: true
      },
      agencyDocuments: [],
      defaultProvider: null,
      explanation: '',
      editHoliday: {},
      editAgency: {
          name: '',
          documents: [{
              name: '',
              url: ''
          }]
      }
    }
  },
  computed: {
    ...mapGetters({
      holidayTypes: 'booking/getHolidayTypes',
      travelAgencies: 'booking/getTravelAgencies',
      providers: 'booking/getProviders',
      genders: 'booking/getGenders',
      locations: 'booking/getLocations',
      userToken: 'auth/getUserToken'
    }),
    documents() {
      return this.newTravelAgency.documents;
    },
    editDocuments() {
        return this.editAgency.documents;
    },
    agencies() {
        return this.travelAgencies.sort((a, b) => {
            if(a.name < b.name) {
                return -1;
            }
            if(a.name > b.name) {
                return 1;
            }
        });
    },
    holidays() {
        let holidays = [];
        /**
         * extra logic. need to process concrete data
         */
        this.holidayTypes.forEach((item) => {
            if(item.id === 4) {
                holidays.push({id: 4, name: 'Pakketreis'});
            }
            if(item.id > 5) {
                holidays.push(item);
            }
        });
        return holidays;
    },
      /**
       * Extra logic, because customer didn't want to do normal
       * NB! id's from server
       */
    pakketreis() {
        let holidays = [];
        holidays.push({id: 4, name: 'Reisorganisator', url: this.holidayTypes[0].url, explanation: this.holidayTypes[0].explanation});
        holidays.push({id: 5, name: 'Doorverkoper', url: this.holidayTypes[1].url, explanation: this.holidayTypes[1].explanation});
        return holidays;
    }
  },
  watch: {
      providers() {
          this.defaultProvider = this.providers[1];
          this.selectProvider(this.defaultProvider);
      }
  },
  methods: {
    ...mapActions({
      setHolidayTypes: 'booking/setHolidayTypes',
      setTravelAgencies: 'booking/setTravelAgencies',
      setProviders: 'booking/setProviders',
      setGenders: 'booking/setGenders',
      setLocations: 'booking/setLocations'
    }),
    addAgency() {
      let params = this.newTravelAgency;
      api.postRequest(api.urls.travelAgencies, params).then(res => {
        if (res.data.success === true) {
          this.setTravelAgencies();
          this.triggerAddNewTravelAgency();
          this.newTravelAgency = {
            name: '',
          };
          let documents = {
            documents: [{
              name: '',
              url: ''
            }]
          };
          this.newTravelAgency.documents = [documents];
          this.i = 0;
          this.$notify({
            group: 'main',
            title: 'Success!',
            text: 'Travel agency successfully added!',
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
    addBooking() {
        /**
         * Because of the download for a file works only in case of 'GET' request
         * so we need to make query string from data
         */
      let params = this.customer;
      params.holiday_type_id = this.selectedHoliday;
      //params.agencies = this.selectedAgencies;
      params.provider_id = this.selectedProvider;
      params.anvr_conditions_apply = params.anvr_conditions_apply * 1;
      params.own_conditions_apply = params.own_conditions_apply * 1;
      let url = api.urls.reservation + '?';
      for(let key in params) {
          if(params.hasOwnProperty(key)) {
              url = url + key + '=' + params[key] + '&';
          }
      }
      url = url + 'agencies[]=';
      for(let key in this.selectedAgencies) {
          if(this.selectedAgencies.hasOwnProperty(key)) {
              url = url + this.selectedAgencies[key];
              url += ',';
          }
      }
      url = url.substring(0, url.length - 1)
        /**
         * for now pdf downloading only in case of Reisbureau Friesland
         */
      if(params.provider_id === 2 && params.location_id < 3) {
          this.showThirdSection = false;
          this.showFirstSection = true;
          this.clearData();
          window.open(url + '&token=' + this.userToken);
      } else {
          api.getRequest(url).then(res => {
              if (res.data.success === true) {
                  this.showThirdSection = false;
                  this.showFirstSection = true;
                  this.clearData();
                  this.$notify({
                      group: 'main',
                      title: 'Success!',
                      text: 'Booking saved!',
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
    addDocument() {
      let newDocument = {
        name: '',
        url: ''
      };
      this.newTravelAgency.documents = [...this.newTravelAgency.documents, newDocument];
    },
    removeDocument(index) {
      this.newTravelAgency.documents.splice(index, 1);
    },
    removeEditDocument(index) {
      this.editAgency.documents.splice(index, 1);
    },
    addEditDocument() {
        let newDocument = {
            name: '',
            url: ''
        };
        this.editAgency.documents = [...this.editAgency.documents, newDocument];
    },
    addHoliday() {
      let params = {
        name: this.newHoliday.type,
        url: this.newHoliday.url,
        explanation: this.newHoliday.explanation
      };
      api.postRequest(api.urls.holidayTypes, params).then(res => {
        if (res.data.success === true) {
          this.setHolidayTypes();
          this.newHoliday.type = '';
          this.newHoliday.url = '';
          this.newHoliday.explanation = '';
          this.triggerAddNewHolidayType();
          this.$notify({
            group: 'main',
            title: 'Success!',
            text: 'Holiday type successfully added!',
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
    editHolidayForm() {
        let params = this.editHoliday;
        if(params.url == '') {
            params.url = '-';
        }
        api.putRequest(api.urls.holidayTypes + '/' + params.id, params).then(res => {
            if (res.data.success === true) {
                this.setHolidayTypes();
                this.triggerEditHolidayModal(null);
                this.$notify({
                    group: 'main',
                    title: 'Success!',
                    text: 'Holiday type successfully edited!',
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
    editAgencyForm() {
        let params = this.editAgency;
        api.putRequest(api.urls.travelAgencies + '/' + params.id, params).then(res => {
            if (res.data.success === true) {
                this.setTravelAgencies();
                this.triggerEditAgencyModal(null);
                this.$notify({
                    group: 'main',
                    title: 'Success!',
                    text: 'Travel agency successfully edited!',
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
    clearData() {
      this.customer = {
        last_name: '',
        email: '',
        own_conditions_apply: true,
        anvr_conditions_apply: true
      };
      this.selectedHoliday = null;
      this.selectedAgencies = null;
      this.selectedProvider = null;
      this.agencyDocuments = [];
    },
    deleteHoliday(id) {
      api.deleteRequest(api.urls.holidayTypes + '/' + id).then(res => {
        if (res.data.success === true) {
          this.selectedHoliday = null;
          this.setHolidayTypes();
          this.$notify({
            group: 'main',
            title: 'Success!',
            text: 'Holiday type successfully deleted!',
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
    deleteAgency(id) {
      api.deleteRequest(api.urls.travelAgencies + '/' + id).then(res => {
        if (res.data.success === true) {
          this.selectedAgencies = null;
          this.agencyDocuments = [];
          this.setTravelAgencies();
          this.$notify({
            group: 'main',
            title: 'Success!',
            text: 'Agency successfully deleted!',
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
    selectHolidayType(data) {
      if (data !== null) {
        this.selectedHoliday = data.id;
        this.explanation = data.explanation;
      }
    },
    selectAgency(data) {
      let i = 0;
      this.agencyDocuments = [];
      this.selectedAgencies = [];
      data.forEach((item) => {
        if (this.selectedAgencies === null) {
          this.selectedAgencies = [];
        }
        this.selectedAgencies.push(item.id);
        item.documents.forEach((item) => {
          if (!this.agencyDocuments.hasOwnProperty(i)) {
            this.agencyDocuments[i] = [];
          }
          if (this.agencyDocuments[i].length === 2) {
            i++;
            this.agencyDocuments[i] = [];
          }
          this.agencyDocuments[i].push(item);
        });
      });
    },
    selectGender(data) {
      if(data !== null) {
          this.customer.gender_id = data.id;
      }
    },
    selectLocation(data) {
      if(data !== null) {
          this.customer.location_id = data.id;
      }
    },
    selectProvider(data) {
      if (data !== null) {
        this.selectedProvider = data.id;
      }
    },
    setActiveSlide(id) {
      this.activeHeader = (this.activeHeader !== id) ? id : 0;
      switch (id) {
        case 1:
          this.showFirstSection = !this.showFirstSection;
          this.showSecondSection = false;
          this.showThirdSection = false;
          break;
        case 2:
          this.showSecondSection = !this.showSecondSection;
          this.showFirstSection = false;
          this.showThirdSection = false;
          break;
        case 3:
          this.showThirdSection = !this.showThirdSection;
          this.showFirstSection = false;
          this.showSecondSection = false;
          break;
      }
    },
    submitAgencyForm() {
      this.$refs.agencyButton.click();
    },
    submitEditAgencyForm() {
      this.$refs.agencyEditButton.click();
    },
    submitHolidayForm() {
      this.$refs.holidayButton.click();
    },
    submitEditHolidayForm() {
      this.$refs.editHolidayButton.click();
    },
    triggerAddNewHolidayType() {
      this.isVisibleNewHolidayType = !this.isVisibleNewHolidayType;
    },
    triggerAddNewTravelAgency() {
      this.isVisibleNewTravelAgency = !this.isVisibleNewTravelAgency;
    },
    triggerEditHolidayModal(data) {
      this.editHoliday = data;
      this.isVisibleEditHoliday = !this.isVisibleEditHoliday;
    },
    triggerEditAgencyModal(data) {
        this.editAgency = data;
        this.isVisibleEditAgency = !this.isVisibleEditAgency;
    },
    validateBookingBeforeSend() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.addBooking();
          return;
        }
      });
    },
    validateAddHolidayBeforeSubmit() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.addHoliday();
          return;
        }
      });
    },
    validateEditHolidayBeforeSubmit() {
        this.$validator.validateAll().then(result => {
            if (result) {
                this.editHolidayForm();
                return;
            }
        });
    },
    validateAddTravelAgencyBeforeSubmit() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.addAgency();
          return;
        }
      });
    },
    validateEditAgencyBeforeSubmit() {
        this.$validator.validateAll().then(result => {
            if (result) {
                this.editAgencyForm();
                return;
            }
        });
    },
  },
  beforeMount() {
    this.setHolidayTypes();
    this.setTravelAgencies();
    this.setProviders();
    this.setGenders();
    this.setLocations();
  },
  components: {
    Modal,
    vSelect
  }
}
</script>

<template>
    <div class="js-datepicker">
        <input type="text" ref="datepicker" class="form-control" :value="value" :placeholder="placeholder" :name="name" :disabled="disableRule === false"/>
    </div>
</template>

<style>
.js-datepicker .flatpickr-input {
  background-color: #fff;
}
</style>

<script>
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";
import moment from "moment";

export default {
  name: "Datepicker",
  props: {
    value: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      default: moment().format("DD MMM YYYY")
    },
    name: {
      type: String,
      default: ""
    },
    disableRule: {
        type: Boolean,
        default: true
    }
  },
  data: () => ({
    fp: null,
    date: ""
  }),
  watch: {
    value: "updateDatepicker"
  },
  methods: {
    updateDatepicker() {
      if (this.fp) {
        this.fp.setDate(this.value);
      }
    },
    initCalendar() {
      this.fp = flatpickr(this.$refs.datepicker, {
        dateFormat: "d M Y H:i",
        enableTime: true,
        onChange: (selectedDates, dateStr) => {
          this.$emit("input", dateStr);
        }
      });
    }
  },
  mounted() {
    this.initCalendar();
  }
};
</script>
<style scoped>
input {
  min-width: 150px;
}
</style>
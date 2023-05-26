<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <slot name="header">
      </slot>
      <div class="modal-container">

        <div class="modal-header">
          <div class="popup__close" aria-label="Close" @click="closeModal"></div>
        </div>

        <div class="modal-body">
          <slot name="body">
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },

  methods: {
    closeModal() {
      this.$emit('close');
    }
  }
};
</script>
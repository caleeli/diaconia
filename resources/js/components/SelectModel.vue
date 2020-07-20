<template>
  <d-select v-if="searchable"
    v-model="model"
    :data="data"
    :id-field="idField"
    :text-field="textField"
    :search-in="[textField]"
    :api="api"
    :filter-by="textField"
    :rows="10"
  >
  </d-select>
  <b-form-select v-else
    v-model="model"
    :options="data2"
    :value-field="idField"
    :text-field="textField"
  ></b-form-select>
</template>

<script>
import { get } from 'lodash';

export default {
  props: {
    value: null,
    api: Object,
    data: Array,
    searchable: Boolean,
    idField: {
      type: String,
      default: 'attributes.valor',
    },
    textField: {
      type: String,
      default: 'attributes.descripcion',
    },
  },
  computed: {
    model: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      },
    },
  },
  data() {
    return {
      data2: this.data || this.api.array({per_page: 1000}),
    };
  },
}
</script>

<style>
.selected-input {
  position: absolute;
  top: 0;
  width: 4em !important;
  right: 0px;
  height: 100%;
  background-size: 50% 50%;
}
.dropdown .selected-option {
  min-height: 34px;
}
</style>

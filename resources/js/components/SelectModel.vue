<template>
  <select-box v-if="searchable"
    v-model="model"
    :data="data"
    :id-field="idField"
    :filter-by="textField"
    :rows="10"
  >
    <template slot-scope="{ row, remove, format }">
      <span v-if="remove">
        {{ row.attributes.valor }}
      </span>
      <span v-else>
        <span v-html="format(text(row))"></span>
      </span>
    </template>
  </select-box>
  <b-form-select v-else
    v-model="model"
    :options="data"
    value-field="attributes.valor"
    text-field="attributes.descripcion"
  ></b-form-select>
</template>

<script>
import { get } from 'lodash';

export default {
  props: {
    value: null,
    api: Object,
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
      data: this.api.array({per_page: 1000}),
    };
  },
  methods: {
    text(row) {
      return get(row, this.textField);
    },
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

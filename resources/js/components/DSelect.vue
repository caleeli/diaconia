<template>
  <b-dropdown
    ref="dropdown"
    split
    split-variant="outline-secondary"
    split-class="p-0 overflow-hidden"
    variant="outline-secondary"
    text="Split Variant Dropdown"
    class="d-select w-100"
  >
    <template v-slot:button-content>
      <input ref="text" class="form-control" :class="cssText" v-model="text" @input="find" @focus.stop="focus">
    </template>
    <b-dropdown-item
      v-for="(row, index) in data"
      :key="`dselect-${index}`"
      @click="select(row)"
    >
      <div >{{ getText(row) }}</div>
    </b-dropdown-item>
  </b-dropdown>
</template>

<script>
import { get, debounce } from 'lodash';

export default {
  props: {
    value: null,
    api: Object,
    data: {
      type: Array,
      default() {
        return [];
      },
    },
    params: {
      type: Object,
      default() {
        return {
          filter: [],
        };
      },
    },
    searchIn: Array,
    idField: {
      type: String,
      default: 'id',
    },
    textField: {
      type: String,
      default: 'attributes',
    },
    debounce: {
      type: Number,
      default: 300,
    },
  },
  model: {
    prop: 'value',
    event: 'change',
  },
  data() {
    if (!this.data.ready) {
      this.data.ready = true;
      this.api.refresh(this.data, this.params);
    }
    return {
      text: '',
    };
  },
  computed: {
    cssText() {
      return this.value ? 'selected' : 'non-selected';
    },
  },
  methods: {
    focus() {
      this.$refs.dropdown.visibleChangePrevented = true;
      this.$refs.dropdown.visible = true;
    },
    loadData() {
      console.log(this.text, this);
      this.params.filter = [`whereAjaxFilter,${JSON.stringify(this.text)},${this.searchIn.join(',')}`];
      this.api.refresh(this.data, this.params);
    },
    find() {
      this.$emit('change', null);
      this.loadData();
    },
    select(row) {
      this.$emit('change', this.getId(row));
      this.text = this.getText(row);
    },
    getId(row) {
      return get(row, this.idField)
    },
    getText(row) {
      return get(row, this.textField)
    },
  },
  mounted() {
    this.loadData = debounce(this.loadData, this.debounce);
  },
}
</script>

<style>
.d-select input {
  border: none;
  border-radius: 0px;
}
.d-select-open {
  display: block!important;
}
.d-select input.non-selected {
  font-style: italic;
}
</style>

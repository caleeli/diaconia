<template>
  <div>
    <div>
      <a v-if="archivo" :href="archivo.url" target="_blank">{{ archivo.name }}</a>
    </div>
    <upload v-model="archivo">
      <button type="button" class="btn btn-secondary">{{__('Subir Archivo')}}</button>
    </upload>
  </div>
</template>
<script>
export default {
  props: {
    value: null
  },
  computed: {
    archivo: {
      get() {
        return this.value;
      },
      set(archivo) {
        this.$emit("change", archivo);
      }
    },
    info() {
      return this.archivo;
    }
  }
};
</script>
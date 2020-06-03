<template>
  <panel class="panel-secondary">
    <template slot="header">
      <title-bar /> <i class="fa fa-list"></i> {{ __('Plantillas') }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <tabla :fields="fields" :form-fields="formFields" :api="api" title="Plantillas"
      :search-in="['attributes.name']"
    >
      <template v-slot:actions="data">
        <b-button @click="editarPlantilla(data.item)" variant="info"><i class="fas fa-list"></i></b-button>
      </template>
    </tabla>
  </panel>

</template>

<script>
export default {
  path: "/plantillas",
  mixins: [window.ResourceMixin],
  data() {
    return {
      api: this.$api.plantillas,
      fields: [
        {key:'id', label: 'id'},
        {key:'attributes.name', label: 'Nombre'},
        {key:'actions', label: ''},
      ],
      formFields: [
        {key:'attributes.name', label: 'Nombre', create: true, edit: true },
      ],
    };
  },
  methods: {
    editarPlantilla(plantilla) {
      this.$router.push({path:`/plantilla/${plantilla.id}`});
    },
  },
}
</script>

<style>

</style>
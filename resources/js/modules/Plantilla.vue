<template>
  <panel v-if="plantilla.attributes" class="panel-secondary">
    <template slot="header">
      <title-bar /> <i class="fa fa-list"></i> {{ __('Plantilla') }} - {{ plantilla.attributes.name }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <tabla ref="preguntas"
      :fields="fields" :form-fields="formFields" :api="api" title="Pregunta"
      :inline="true"
      :params="{ per_page: -1, sort:'grupo,indice' }"
      @change="refreshTable"
      :search-in="['attributes.grupo', 'attributes.indice', 'attributes.descripcion']"
    >
      <template slot="toolbar">
        <router-link class="btn btn-primary" :to="`/plantilla/${plantilla.id}/preview`" data-cy="tabla.vista-previa"><i class="fas fa-eye"></i> {{ __('Vista previa') }}</router-link>
      </template>
    </tabla>
  </panel>

</template>

<script>
export default {
  path: "/plantilla/:id",
  mixins: [window.ResourceMixin],
  data() {
    return {
      plantilla: this.$api.plantilla.row(this.$route.params.id),
      api: this.$api[`plantilla/${this.$route.params.id}/preguntas`],
      fields: [
        {key:'attributes.grupo', label: 'Grupo'},
        {key:'attributes.indice', label: 'Índice'},
        {key:'attributes.descripcion', label: 'Descripción'},
        {key:'actions', label: ''},
      ],
      formFields: [
        {key:'attributes.grupo', label: 'Grupo', create: true, edit: true },
        {key:'attributes.indice', label: 'Índice', create: true, edit: true },
        {key:'attributes.descripcion', label: 'Descripción', create: true, edit: true },
      ],
    };
  },
  methods: {
    refreshTable() {
      let pendientes = 0;
      this.$refs.preguntas.value.forEach(row => {
        if (row.edit) pendientes++;
      });
      if (!pendientes) {
        this.$refs.preguntas.loadData();
      }
    },
  },
}
</script>

<style>

</style>
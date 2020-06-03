<template>
  <panel v-if="plantilla.attributes" class="panel-secondary">
    <template slot="header">
      <title-bar /> <i class="fa fa-eye"></i> {{ __('Plantilla') }} - {{ plantilla.attributes.name }}
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
      readonly
    >
      <template slot="toolbar">
        <router-link class="btn btn-primary" :to="`/plantilla/${plantilla.id}`"><i class="fas fa-list"></i> {{ __('Editar') }}</router-link>
      </template>
      <template v-slot:cell(revision)="data">
        <select-model :api="$api.combo_revision" v-model="data.item.revision" />
      </template>
      <template v-slot:cell(clasificacion)="data">
        <select-model :api="$api.combo_clasificacion" v-model="data.item.clasificacion" searchable />
      </template>
      <template v-slot:cell(observacion)="data">
        <b-form-textarea v-model="data.item.observacion" />
      </template>
      <template v-slot:cell(tipo_observacion)="data">
        <select-model :api="$api.combo_tipo_informe" v-model="data.item.tipo_observacion" />
      </template>
      <template v-slot:cell(riesgo_adicional)="data">
        <select-model :api="$api.combo_riesgo" v-model="data.item.riesgo_adicional" />
      </template>
    </tabla>
  </panel>
</template>

<script>
export default {
  path: "/plantilla/:id/preview",
  mixins: [window.ResourceMixin],
  data() {
    return {
      plantilla: this.$api.plantilla.row(this.$route.params.id),
      api: this.$api[`plantilla/${this.$route.params.id}/preguntas`],
      fields: [
        //{key:'attributes.grupo', label: 'Grupo'},
        {key:'attributes.indice', label: 'Índice'},
        {key:'attributes.descripcion', label: 'Detalle'},
        {key:'revision', label: 'Revisión', extra: true},
        {key:'clasificacion', label: 'Clasificación', extra: true},
        {key:"observacion", label: "Observacion", extra: true},
        {key:"tipo_observacion", label: "Tipo observacion", extra: true},
        {key:"riesgo_adicional", label: "Riesgo adicional/control int.", extra: true},
        //{key:"relationships.pregunta.plantilla_id", label: "tipo_credito"},
        //{key:"attributes.informe", label: "informe"},
        //{key:"attributes.carpeta_id", label: "prmprnpre"}
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

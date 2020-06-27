<template>
  <panel v-if="plantilla.attributes" class="panel-secondary">
    <template slot="header">
      <title-bar /> <i class="fa fa-eye"></i> {{ __('Plantilla') }} - {{ plantilla.attributes.name }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <div class="w-100 text-right">
      <div class="btn-group text-nowrap" role="group">
        <b-button variant="primary" @click="volver" data-cy="plantilla-volver"><i class="fas fa-arrow-left"></i></b-button>
      </div>
    </div>
    <b-table-simple>
      <b-tbody>
        <b-tr v-for="pregunta in preguntas" :key="`pregunta-${pregunta.id}`">
          <b-td v-if="pregunta.attributes.indice">
            {{ pregunta.attributes.indice }}
          </b-td>
          <b-td
            :colspan="pregunta.attributes.indice ? 1 : 7"
            style="width:30%;"
            v-html="pregunta.attributes.descripcion">
          </b-td>
          <b-td v-if="pregunta.attributes.indice">
            <select-model
              :api="$api.combo_revision"
              v-model="pregunta.respuesta"
              data-cy="pregunta.respuesta"
            />
          </b-td>
          <b-td v-if="pregunta.attributes.indice">
            <select-model
              :api="$api.clasificaciones"
              v-model="pregunta.clasificacion"
              data-cy="pregunta.clasificacion"
              searchable
              text-field="attributes.valor"
              style="width: 120px;"
            />
          </b-td>
          <b-td v-if="pregunta.attributes.indice">
            <b-form-textarea
              v-model="pregunta.observacion"
              data-cy="pregunta.observacion"
            />
          </b-td>
          <b-td v-if="pregunta.attributes.indice">
            <select-model
              :api="$api.combo_tipo_informe"
              v-model="pregunta.tipo_observacion"
              data-cy="pregunta.tipo_observacion"
            />
          </b-td>
          <b-td v-if="pregunta.attributes.indice">
            <select-model
              :api="$api.riesgos"
              v-model="pregunta.riesgo_adicional"
              data-cy="pregunta.riesgo_adicional"
            />
          </b-td>
        </b-tr>
      </b-tbody>
    </b-table-simple>
  </panel>
</template>

<script>
export default {
  path: "/plantilla/:id/preview",
  mixins: [window.ResourceMixin],
  data() {
    return {
      plantilla: this.$api.plantilla.row(this.$route.params.id),
      preguntas: this.$api[`plantilla/${this.$route.params.id}/preguntas`].array({ per_page: -1, sort:'grupo,indice' }),
      api: this.$api[`plantilla/${this.$route.params.id}/preguntas`],
      fields: [
        //{key:'attributes.grupo', label: 'Grupo'},
        {key:'attributes.indice', label: 'Índice'},
        {key:'attributes.descripcion', label: 'Detalle'},
        {key:'respuesta', label: 'Revisión', extra: true},
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
    volver() {
      this.$router.go(-1);
    },
  },
}
</script>

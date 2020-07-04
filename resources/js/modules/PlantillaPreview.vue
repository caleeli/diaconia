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
              :data="revisiones"
              v-model="pregunta.respuesta"
              data-cy="pregunta.respuesta"
            />
          </b-td>
          <b-td v-if="pregunta.attributes.indice">
            <select-model
              :data="clasificaciones"
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
              :data="tipo_informes"
              v-model="pregunta.tipo_observacion"
              data-cy="pregunta.tipo_observacion"
            />
          </b-td>
          <b-td v-if="pregunta.attributes.indice">
            <select-model
              :data="riesgos"
              v-model="pregunta.riesgo_adicional_id"
              data-cy="pregunta.riesgo_adicional_id"
              id-field="id"
              text-field="attributes.nombre"
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
      revisiones: this.$api.combo_revision.array({per_page: 1000}),
      riesgos: this.$api.riesgos.array({per_page: 1000}),
      clasificaciones: this.$api.clasificaciones.array({per_page: 1000}),
      tipo_informes: this.$api.combo_tipo_informe.array({per_page: 1000}),
      riesgos: this.$api.riesgos.array({per_page: 1000}),
      plantilla: this.$api.plantilla.row(this.$route.params.id),
      preguntas: this.$api[`plantilla/${this.$route.params.id}/preguntas`].array({ per_page: -1, sort:'grupo,indice' }),
      api: this.$api[`plantilla/${this.$route.params.id}/preguntas`],
    };
  },
  methods: {
    volver() {
      this.$router.go(-1);
    },
  },
}
</script>

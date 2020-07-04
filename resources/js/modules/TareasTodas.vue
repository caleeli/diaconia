<template>
  <panel :name="__('TareasTodas')" class="panel-secondary">
    <template slot="header">
      <title-bar />
      <i class="fa fa-sucursales"></i>
      {{ __('TareasTodas') }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <tabla
      :fields="fields"
      :form-fields="formFields"
      :api="api"
      :title="__('TareasTodas')"
      :search-in="['attributes.nombre']"
    >
      <template v-slot:cell(attributes.entregable)="data">
        <a
          v-if="data.item.attributes.entregable"
          :href="data.item.attributes.entregable.url"
          target="_blank"
        >{{ data.item.attributes.entregable.name }}</a>
      </template>
      <template v-slot:cell(attributes.entregable_fecha)="data">
        <datetime
          v-if="data.item.attributes.entregable"
          :value="data.item.attributes.entregable_fecha"
          read-only
        />
      </template>
      <template v-slot:cell(attributes.vencimiento)="data">
        <datetime
          v-if="data.item.attributes.vencimiento"
          :value="data.item.attributes.vencimiento"
          read-only
        />
      </template>
    </tabla>
  </panel>
</template>
<script>
import moment from "moment";
export default {
  name: "TareasTodas",
  path: "/todas",
  mixins: [window.ResourceMixin],
  data() {
    return {
      moment,
      api: this.$api.tareas,
      fields: [
        { key: "id", label: "id" },
        { key: "attributes.nombre", label: "Nombre" },
        { key: "attributes.entregable", label: "Entregable" },
        { key: "attributes.entregable_fecha", label: "Fecha Entregable" },
        { key: "attributes.vencimiento", label: "Vencimiento" },
        { key: "attributes.estado", label: "Estado" },
        { key: "attributes.creador_id", label: "Creador" },
        { key: "actions", label: "" }
      ],
      formFields: [
        { key: "attributes.nombre", label: "nombre", create: true, edit: true },
        {
          key: "attributes.entregable",
          label: "Entregable",
          create: true,
          edit: true,
          component: "subir-archivo"
        },
        {
          key: "attributes.vencimiento",
          label: "Vencimiento",
          create: true,
          edit: true,
          component: "datetime"
        },
        { key: "attributes.estado", label: "Estado", create: true, edit: true },
        {
          key: "attributes.creador_id",
          label: "Creador",
          create: true,
          edit: false,
          component: "b-select",
          properties: {}
        }
      ]
    };
  },
  mounted() {
    this.$api.tareas.call(1, "todosUsuarios", {}).then(response => {
      this.formFields[4].properties.options = response;
    });
  }
};
</script>
<style scoped>
</style>
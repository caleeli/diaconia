<template>
  <panel :name="__('Riesgos')" class="panel-secondary">
    <template slot="header">
      <title-bar />
      <i class="fas fa-exclamation-triangle"></i>
      {{ __('Riesgos') }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <tabla
      :fields="fields"
      :form-fields="formFields"
      :api="api"
      :title="__('Riesgos')"
      :search-in="['attributes.nombre', 'attributes.descripcion']"
    >
      <template v-slot:cell(attributes.color)="{ item }">
        <label
          class="badge"
          :style="{ background: item.attributes.color }"
        >{{ item.attributes.color }}</label>
      </template>
    </tabla>
  </panel>
</template>

<script>
export default {
  name: "Riesgos",
  path: "/riesgos",
  mixins: [window.ResourceMixin],
  data() {
    return {
      api: this.$api.riesgos,
      fields: [
        { key: "id", label: "id" },
        { key: "attributes.nombre", label: "Nombre" },
        { key: "attributes.color", label: "Color" },
        { key: "attributes.ponderacion", label: "Ponderación" },
        { key: "actions", label: "" }
      ],
      formFields: [
        {
          key: "attributes.nombre",
          label: "Nombre",
          create: true,
          edit: true,
          component: "b-form-input",
        },
        {
          key: "attributes.color",
          label: "Color",
          create: true,
          edit: true,
          component: "b-form-input",
        },
        {
          key: "attributes.ponderacion",
          label: "Ponderación",
          create: true,
          edit: true,
          component: "b-form-input",
        },
      ]
    };
  }
};
</script>

<style scoped>
</style>

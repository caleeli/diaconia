<template>
  <panel :name="__('Clasificaciones')" class="panel-secondary">
    <template slot="header">
      <title-bar />
      <i class="fa fa-clasificaciones"></i>
      {{ __('Clasificaciones') }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <tabla
      :fields="fields"
      :form-fields="formFields"
      :api="api"
      :title="__('Clasificaciones')"
      :search-in="['attributes.valor']"
    ></tabla>
  </panel>
</template>

<script>
export default {
  name: "Clasificaciones",
  path: "/clasificaciones",
  mixins: [window.ResourceMixin],
  data() {
    return {
      api: this.$api.clasificaciones,
      fields: [
        { key: "id", label: "id" },
        { key: "attributes.valor", label: "Valor" },
        { key: "actions", label: "" }
      ],
      formFields: [
        {
          key: "attributes.valor",
          label: "Valor",
          create: true,
          edit: true,
          component: "b-textarea",
          properties: {rows: 5}
        }
      ]
    };
  }
};
</script>

<style scoped>
</style>

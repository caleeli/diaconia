<template>
  <panel :name="__('Sucursales')" class="panel-secondary">
    <template slot="header">
      <title-bar />
      <i class="fa fa-sucursales"></i>
      {{ __('Sucursales') }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <tabla
      :fields="fields"
      :form-fields="formFields"
      :api="api"
      :title="__('Sucursales')"
      :search-in="['attributes.valor', 'attributes.descripcion']"
    >
    </tabla>
  </panel>
</template>

<script>
export default {
  name: "Sucursales",
  path: "/sucursales",
  mixins: [window.ResourceMixin],
  data() {
    return {
      api: this.$api.sucursales,
      fields: [
        { key: "id", label: "id" },
        { key: "attributes.valor", label: "Valor" },
        { key: "attributes.descripcion",  label: "Descripcion" },
        { key: "actions", label: "" }
      ],
      formFields: [
        { key: "attributes.valor", label: "Valor", create: true, edit: true },
        {
          key: "attributes.descripcion",
          label: "Descripcion",
          create: true,
          edit: true
        }
      ],
    };
  }
};
</script>

<style scoped>
</style>

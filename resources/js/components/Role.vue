<template>
  <div>
    <tabla :fields="fields" :form-fields="formFields" :api="api" :title="__('Role')"
      :search-in="['attributes.name']"
      :params="{order_by:'parent,id'}"
    >
      <template v-slot:cell(id)="data">
        {{ data.item.attributes.parent ? `${data.item.attributes.parent}.${data.item.id}` : data.item.id }}
      </template>
      <template v-slot:cell(attributes.icon)="data">
        <i :class="data.item.attributes.icon"></i>
      </template>
    </tabla>
  </div>
</template>

<script>
export default {
  props: {
    role: Object,
  },
  mixins: [window.ResourceMixin],
  data() {
    return {
      user: {},
      api: this.$api[`role/${this.role.id}/menus`],
      fields: [
        {key:'id', label: '#'},
        {key:'attributes.code', label: 'Código'},
        {key:'attributes.name', label: 'Nombre'},
        {key:'attributes.icon', label: 'Icono' },
        {key:'actions', label: ''},
      ],
      formFields: [
        {
          key:'attributes.parent',
          label: 'Padre',
          create: true,
          edit: true,
          component: "b-select",
          properties: {
            options: [],
          },
        },
        {key:'attributes.code', label: 'Code', create: true, edit: true },
        {key:'attributes.name', label: 'Nombre', create: true, edit: true },
        {key:'attributes.icon', label: 'Icono', create: true, edit: true, component: 'fa-picker' },
        {key:'attributes.path', label: 'Ruta', create: true, edit: true },
      ],
    };
  },
  mounted() {
    this.$api[`role/${this.role.id}/menus`]
      .index({ per_page:-1, where: ['whereNull,parent'] })
      .then((res) => {
        const options = [
          {
            value: null,
            text: '',
          }
        ];
        res.data.data.forEach((menu) => {
          options.push({
            value: menu.id,
            text: menu.attributes.name,
          });
        });
        this.formFields[0].properties.options = options;
      });
  },
};
</script>

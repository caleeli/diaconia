<template>
  <div>
    <h1>Tranlations</h1>
    <div>By key: {{ __('auth.failed') }}</div>
    <div>{{ __('Non existing translated label') }}</div>
    <div>By string: {{ __('Home') }}</div>
    <div>Invalid: {{ __(null) }}</div>
    <div>Parameters: {{ __('validation.string', {attribute: 'field'}) }}</div>
    <b-button @click="checkFormulario" data-cy="check.form">form</b-button>
    <d-select :api="api" text-field="attributes.name" data-cy="core-d-select" />
    <modal-form
      id="changePassword"
      title="Cambiar contraseña"
      v-model="user"
      :fields="changePasswordFields"
      :api="api"
      ref="formulario"
    ></modal-form>
    <tabla
      :fields="fields" :form-fields="formFields" :api="apiPreguntas" title="Pregunta"
      :search-in="['attributes.grupo', 'attributes.indice', 'attributes.descripcion']"
    >
    </tabla>
  </div>
</template>

<script>
export default {
  path: '/core',
  mixins: [window.ResourceMixin],
  data() {
    return {
      user: {},
      api: this.$api.user,
      changePasswordFields: [
        { key: "attributes.password", label: "Contraseña", type: "password" },
        {
          key: "confirm_password",
          label: "Confirmar contraseña",
          type: "password"
        }
      ],
      // Tabla de preguntas
      apiPreguntas: this.$api.preguntas,
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
    checkFormulario() {
      this.$refs.formulario.show();
      this.$nextTick(() => {
        this.$refs.formulario.error;
      });
    },
  },
}
</script>

<style>

</style
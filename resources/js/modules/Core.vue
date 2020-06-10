<template>
  <div>
    <h1>Tranlations</h1>
    <div>By key: {{ __('auth.failed') }}</div>
    <div>{{ __('Non existing translated label') }}</div>
    <div>By string: {{ __('Home') }}</div>
    <div>Invalid: {{ __(null) }}</div>
    <div>Parameters: {{ __('validation.string', {attribute: 'field'}) }}</div>
    <b-button @click="checkFormulario" data-cy="check.form">form</b-button>
    <modal-form
      id="changePassword"
      title="Cambiar contraseña"
      v-model="user"
      :fields="changePasswordFields"
      :api="api"
      ref="formulario"
    ></modal-form>
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
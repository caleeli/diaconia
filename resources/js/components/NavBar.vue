<template>
  <div class="d-flex ml-2">
    <b-button v-if="$root.currentRequests > 0" variant="outline-light" class="text-black"><i class='fas fa-spinner fa-spin'></i></b-button>
    <div class="btn-group text-nowrap mr-2" role="group">
      <slot />
      <router-link to="/" class="btn btn-warning" data-cy="menu.home"><i class="fas fa-home"></i> {{ __('Home') }}</router-link>
      <template v-for="menu in $root.menus">
        <router-link v-if="menu.path" :key="`menu-${menu.id}`"
          :to="menu.path" :class="`btn btn-${menu.variant}`" :data-cy="`menu.${menu.code}`"><i :class="menu.icon"></i> {{ __(menu.name) }}</router-link>
        <b-dropdown
          v-else
          :key="`menu-${menu.id}`"
          :variant="menu.variant"
          :data-cy="`menu.${menu.code}`"
          right
        >
          <template slot="button-content">
            <i :class="menu.icon"></i>
            {{ __(menu.name) }}
          </template>
          <b-dropdown-item
            v-for="submenu in menu.menus"
            :key="`menu-${menu.id}-${submenu.id}`"
            :variant="submenu.variant"
          >
            <router-link
              :data-cy="`menu.${submenu.code}`"
              :key="`menu-${submenu.id}`"
              :to="submenu.path"
            >
              <i :class="submenu.icon"></i> {{ __(submenu.name) }}
            </router-link>
          </b-dropdown-item>
        </b-dropdown>
      </template>
    </div>
    <b-dropdown split class="mr-2" variant="outline-primary" data-cy="navbar.notifications">
      <template v-slot:button-content>
        <i class="fas fa-bell"></i>
        <b-badge variant="warning">{{alertas.length}}</b-badge>
      </template>
      <b-dropdown-item
        v-for="(row, index) in alertas"
        :key="`dselect-${index}`"
        @click="select(row)"
        >
        {{ row.attributes.texto }}
      </b-dropdown-item>
    </b-dropdown>
    <form class="m-0" action="/logout" method="post">
    <div class="btn-group" role="group">
      <router-link v-if="$root.user.attributes" to="/profile" data-cy="navbar.profile" class="btn btn-outline-secondary text-nowrap pr-4">
        {{ $root.user.attributes.name }} <avatar v-model="$root.user" style="font-size: 1.5em;position: absolute;" />
      </router-link>
      <button type="submit" data-cy="navbar.logout" class="btn btn-outline-danger text-nowrap">
        <i class="fas fa-power-off"></i>
      </button>
    </div>
    </form>
  </div>
</template>

<script>
import { get, debounce } from 'lodash';
export default {
    mixins: [window.ResourceMixin],
  data() {
    return {
      alertas: this.$api[`user/${window.userId}/alertas`].array({filter: ['where,no_leido,1']}),
    };
  },
  methods: {
    isEnabled() {
      return this.enableNotifications && this.notificationRequest;
    },
    requestNotificationAccess() {
      if (this.isEnabled()) {
        window.localStorage.enableNotifications = '';
      } else {
        window.localStorage.enableNotifications = '1';
      }
      this.enableNotifications = window.localStorage.enableNotifications;
      /* istanbul ignore next */
      Vue.notification.requestPermission().then(() => {
        this.notificationRequest = Notification.permission;
      });
    },
    getText(row) {
      return get(row, this.textField)
    },
    select(row) {
     this.$api.alerta.call(row.id, "cambiarNoLeidoFalse", {}).then(response => {
        this.$api[`user/${window.userId}/alertas`].refresh(this.alertas, {filter:['where,no_leido,1']});
      });
    },
  },
}
</script>

<style>

</style>
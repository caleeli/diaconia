<template>
  <div class="d-flex ml-2">
    <div class="btn-group text-nowrap mr-2" role="group">
      <slot />
      <router-link to="/" class="btn btn-warning"><i class="fas fa-home"></i> {{ __('Home') }}</router-link>
      <template v-for="menu in $root.menus">
        <router-link v-if="menu.path" :key="`menu-${menu.id}`"
          :to="menu.path" :class="`btn btn-${menu.variant}`"><i :class="menu.icon"></i> {{ __(menu.name) }}</router-link>
        <b-dropdown
          v-else
          :key="`menu-${menu.id}`"
          :variant="menu.variant"
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
            <router-link :key="`menu-${submenu.id}`"
              :to="submenu.path"><i :class="submenu.icon"></i> {{ __(submenu.name) }}</router-link>
          </b-dropdown-item>
        </b-dropdown>
      </template>
    </div>
    <b-button class="mr-2" :variant="isEnabled() ? 'primary' : 'outline-primary'" @click="requestNotificationAccess">
      <i v-if="isEnabled()" class="fas fa-bell"></i>
      <i v-else class="fas fa-bell-slash"></i>
    </b-button>
    <form class="m-0" action="/logout" method="post">
    <div class="btn-group" role="group">
      <router-link v-if="$root.user.attributes" to="/profile" class="btn btn-outline-secondary text-nowrap pr-4">
        {{ $root.user.attributes.name }} <avatar v-model="$root.user" style="font-size: 1.5em;position: absolute;" />
      </router-link>
      <button type="submit" class="btn btn-outline-danger text-nowrap">
        <i class="fas fa-power-off"></i>
      </button>
    </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notificationRequest: Notification.permission,
      enableNotifications: window.localStorage.enableNotifications,
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
      Vue.notification.requestPermission().then(() => {
        this.notificationRequest = Notification.permission;
      });
    },
  },
}
</script>

<style>

</style>
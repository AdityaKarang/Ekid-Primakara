<template>
  <ul class="menu-nav">
    <router-link to="/dosen/dashboard" v-slot="{ href, navigate, isActive, isExactActive }" custom>
      <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item" :class="[
        isActive && 'menu-item-active',
        isExactActive && 'menu-item-active',
      ]">
        <a :href="href" class="menu-link" @click="navigate">
          <i class="menu-icon flaticon2-architecture-and-city"></i>
          <span class="menu-text">Dashboard</span>
        </a>
      </li>
    </router-link>

    <li class="menu-section">
      <h4 class="menu-text">Penelitian Dan Pengabdian</h4>
      <i class="menu-icon flaticon-more-v2"></i>
    </li>

    <router-link to="/dosen/dashboard" v-slot="{ href, navigate, isActive, isExactActive }" custom>
      <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item" :class="[
        isActive && 'menu-item-active',
        isExactActive && 'menu-item-active',
      ]">
        <a :href="href" class="menu-link" @click="navigate">
          <i class="menu-icon flaticon2-architecture-and-city"></i>
          <span class="menu-text">Timeline</span>
        </a>
      </li>
    </router-link>

    <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item menu-item-submenu"
      v-bind:class="{ 'menu-item-open': hasActiveChildren('/dosen/laporan') }">
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon flaticon-edit-1"></i>
        <span class="menu-text">Penelitian</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="menu-submenu">
        <span class="menu-arrow"></span>
        <ul class="menu-subnav">
          <li aria-haspopup="true" class="menu-item menu-item-parent">
            <span class="menu-link">
              <span class="menu-text">Vue Bootstrap</span>
            </span>
          </li>

          <router-link to="/dosen/penelitian" v-slot="{ href, navigate, isActive, isExactActive }" custom>
            <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item" :class="[
              isActive && 'menu-item-active',
              isExactActive && 'menu-item-active',
            ]">
              <a :href="href" class="menu-link" @click="navigate">
                <i class="menu-bullet menu-bullet-dot">
                  <span></span>
                </i>
                <span class="menu-text">Proposal</span>
              </a>
            </li>
          </router-link>
          <router-link to="/dosen/laporan/penelitian" v-slot="{ href, navigate, isActive, isExactActive }" custom>
            <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item" :class="[
              isActive && 'menu-item-active',
              isExactActive && 'menu-item-active',
            ]">
              <a :href="href" class="menu-link" @click="navigate">
                <i class="menu-bullet menu-bullet-dot">
                  <span></span>
                </i>
                <span class="menu-text">Laporan Penelitian</span>
              </a>
            </li>
          </router-link>
        </ul>
      </div>
    </li>

    <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item menu-item-submenu" v-bind:class="{
      'menu-item-open': hasActiveChildren('/dosen/pengabdian'),
    }">
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon flaticon-edit-1"></i>
        <span class="menu-text">Pengabdian</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="menu-submenu">
        <span class="menu-arrow"></span>
        <ul class="menu-subnav">
          <li aria-haspopup="true" class="menu-item menu-item-parent">
            <span class="menu-link">
              <span class="menu-text">Vue Bootstrap</span>
            </span>
          </li>

          <router-link to="/dosen/pengabdian" v-slot="{ href, navigate, isActive, isExactActive }" custom>
            <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item" :class="[
              isActive && 'menu-item-active',
              isExactActive && 'menu-item-active',
            ]">
              <a :href="href" class="menu-link" @click="navigate">
                <i class="menu-bullet menu-bullet-dot">
                  <span></span>
                </i>
                <span class="menu-text">Pengabdian</span>
              </a>
            </li>
          </router-link>
          <router-link to="/dosen/laporan/pengabdian" v-slot="{ href, navigate, isActive, isExactActive }" custom>
            <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item" :class="[
              isActive && 'menu-item-active',
              isExactActive && 'menu-item-active',
            ]">
              <a :href="href" class="menu-link" @click="navigate">
                <i class="menu-bullet menu-bullet-dot">
                  <span></span>
                </i>
                <span class="menu-text">Laporan Pengabdian</span>
              </a>
            </li>
          </router-link>
        </ul>
      </div>
    </li>

    <!-- <router-link to="/dosen/penunjang" v-slot="{ href, navigate, isActive, isExactActive }" custom>
      <li aria-haspopup="true" data-menu-toggle="hover" class="menu-item" :class="[
        isActive && 'menu-item-active',
        isExactActive && 'menu-item-active',
      ]">
        <a :href="href" class="menu-link" @click="navigate">
          <i class="menu-icon flaticon-edit-1"></i>
          <span class="menu-text">Penunjang</span>
        </a>
      </li>
    </router-link> -->
  </ul>
</template>

<script>
export default {
  name: "KTMenu",
  methods: {
    hasActiveChildren(match) {
      return this.$route["path"].indexOf(match) !== -1;
    },
  },
};
</script>

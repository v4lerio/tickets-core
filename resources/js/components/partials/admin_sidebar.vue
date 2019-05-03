<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" :class="{ toggled: collapsed }" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-ticket-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tickets!</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
		<router-link class="nav-link" :to="{ name: 'dashboard' }">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</router-link>
      </li>

            <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Ticket Management
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets_menu" aria-expanded="true" aria-controls="tickets_menu">
          <i class="fas fa-fw fa-ticket-alt"></i>
          <span>Tickets</span>
        </a>
        <div id="tickets_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: '' }">Tickets</router-link>
            <router-link class="collapse-item" :to="{ name: '' }">Create Ticket</router-link>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <div class="sidebar-heading">
        Customer Management
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer_menu" aria-expanded="true" aria-controls="customer_menu">
          <i class="fas fa-fw fa-user"></i>
          <span>Customers</span>
        </a>
        <div id="customer_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: 'customers_index' }">Customers</router-link>
            <router-link class="collapse-item" :to="{ name: 'customers_create' }">Create Customer</router-link>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#organisation_menu" aria-expanded="true" aria-controls="organisation_menu">
          <i class="fas fa-fw fa-users"></i>
          <span>Organisations</span>
        </a>
        <div id="organisation_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: 'organisations_index' }">Organisations</router-link>
            <router-link class="collapse-item" :to="{ name: 'organisations_create' }">Create Organisation</router-link>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Admin
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#departments_menu" aria-expanded="true" aria-controls="departments_menu">
          <i class="fas fa-fw fa-sitemap"></i>
          <span>Departments</span>
        </a>
        <div id="departments_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: 'departments_index' }">Departments</router-link>
            <router-link class="collapse-item" :to="{ name: 'departments_create' }">Create Department</router-link>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#support_types_menu" aria-expanded="true" aria-controls="support_types_menu">
          <i class="fas fa-fw fa-question"></i>
          <span>Support Types</span>
        </a>
        <div id="support_types_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: 'support_types_index' }">Support Types</router-link>
            <router-link class="collapse-item" :to="{ name: 'support_types_create' }">Create Support Type</router-link>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#priorities_menu" aria-expanded="true" aria-controls="priorities_menu">
          <i class="fas fa-fw fa-exclamation"></i>
          <span>Priorities</span>
        </a>
        <div id="priorities_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: 'priorities_index' }">Priorities</router-link>
            <router-link class="collapse-item" :to="{ name: 'priorities_create' }">Create Priority</router-link>
          </div>
        </div>
      </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#statuses_menu" aria-expanded="true" aria-controls="statuses_menu">
          <i class="fas fa-fw fa-check"></i>
          <span>Statuses</span>
        </a>
        <div id="statuses_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: 'statuses_index' }">Statuses</router-link>
            <router-link class="collapse-item" :to="{ name: 'statuses_create' }">Create Status</router-link>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Users_menu" aria-expanded="true" aria-controls="Users_menu">
          <i class="fas fa-fw fa-user"></i>
          <span>Users</span>
        </a>
        <div id="Users_menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" :to="{ name: 'users_index' }">Users</router-link>
            <router-link class="collapse-item" :to="{ name: 'users_create' }">Create User</router-link>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" @click="toggleSidebar"></button>
      </div>

    </ul>
</template>

<script>
    import {EventBus} from '../../EventBus.js';

    export default {
        data() {
            return {
                collapsed: false
            }
        },
        mounted() {
            EventBus.$on('toggleSideBar', () => {
                this.toggleSidebar()
            });
        },
        methods: {
            toggleSidebar() {
                this.collapsed = !this.collapsed;
            }
        }
    }
</script>

<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
            <router-link class="collapse-item" :to="{ name: '' }">Create Customer</router-link>
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
            <router-link class="collapse-item" :to="{ name: '' }">Create Organisation</router-link>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
</template>

<script>
    export default {

    }
</script>

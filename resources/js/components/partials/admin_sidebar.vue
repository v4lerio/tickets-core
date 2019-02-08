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
      <hr class="sidebar-divider my-0">

      <li class="nav-item">
		<router-link class="nav-link" :to="{ name: 'customers_index' }">
			<i class="fas fa-fw fa-user"></i>
			<span>Customers</span>
		</router-link>
      </li>

		<!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item">
		<router-link class="nav-link" :to="{ name: 'organisations_index' }">
			<i class="fas fa-fw fa-users"></i>
			<span>Organisations</span>
		</router-link>
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

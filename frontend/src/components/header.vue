<template>
 <header>
    <nav class="navbar p-5 navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
       <router-link class="navbar-brand" :to="'/'">TicketMaster</router-link>
        <button @click="toggle = !toggle" class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
             <router-link class="nav-link" :to="'/'">HomePage</router-link>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" target="_blank" href="https://github.com/utkuakyuz/ticketmasterAPI">Git Repository</a>
            </li> -->
          </ul>
          <form class="d-flex w-50" @submit.stop.prevent="sendData">
            <input v-model="paginateObj.keyword" class="form-control me-2" type="search" placeholder="Search with some keywords or event name" aria-label="Search" />
            <button class="btn" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
</template>
<script setup>
import { getEvents, paginateObj, toggle } from "../store/content";
import router from '../router';
const sendData = () => {
 router.push('/')
 getEvents();
};
</script>
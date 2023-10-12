<template>
 <div>
     <h2 class="text-center fw-bolder">Welcome to Ticket App</h2>
  <div class="container-sm mt-5">
   <h3 class="mb-3 fst-italic">
     You can search or swipe pages to find your event
   </h3>
   <form v-if="toggle" class="d-flex w-100 mb-5" @submit.stop.prevent="sendData">
      <input v-model="paginateObj.keyword" class="form-control me-2" type="search" placeholder="Search with keywords" aria-label="Search" />
      <button class="btn" type="submit">Search</button>
    </form>
   <Table :rows="EventsData"></Table>
   <Paginate></Paginate>
  </div>
 </div>
</template>

<script setup>
import Table from "../components/table.vue";
import Paginate from "../components/paginate.vue";
import { getEvents, EventsData, paginateObj, toggle } from "../store/content";
let a = true;
const sendData = () => {
 getEvents();
};
getEvents()
</script>
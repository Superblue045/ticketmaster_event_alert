<template>
 Size: {{ paginateObj.size }}, Page: {{ paginateObj.page + 1 }}
 Total Number of Pages: {{ NumberOfPages }}
 <nav class="d-flex flex-wrap">
  <ul class="pagination">
   <li class="page-item">
    <a @click="previousPage" class="page-link" href="#" aria-label="Previous">
     <span aria-hidden="true">&laquo;</span>
    </a>
   </li>
   <li v-if="paginateObj.page > 1" class="page-item">
    <a class="page-link" @click="changePage(0)" href="#">1</a>
   </li>
   <li v-if="paginateObj.page > 2" class="page-item">
    <a class="page-link" href="#">...</a>
   </li>
   <li v-if="paginateObj.page != 0" class="page-item">
    <a @click="changePage(paginateObj.page - 1)" class="page-link" href="#">{{
     paginateObj.page
    }}</a>
   </li>
   <li class="page-item">
    <a @click="changePage(paginateObj.page)" class="page-link" href="#">{{
     paginateObj.page + 1
    }}</a>
   </li>
   <li v-if="paginateObj.page < NumberOfPages - 1" class="page-item">
    <a @click="changePage(paginateObj.page + 1)" class="page-link" href="#">{{
     paginateObj.page + 2
    }}</a>
   </li>
   <li v-if="paginateObj.page < NumberOfPages - 3" class="page-item">
    <a class="page-link" href="#">...</a>
   </li>
   <li v-if="paginateObj.page < NumberOfPages - 2" class="page-item">
    <a @click="changePage(NumberOfPages - 1)" class="page-link" href="#">{{
     NumberOfPages
    }}</a>
   </li>
   <li v-if="paginateObj.page < NumberOfPages - 1" class="page-item">
    <a @click="nextPage" class="page-link" href="#" aria-label="Next">
     <span aria-hidden="true">&raquo;</span>
    </a>
   </li>
  </ul>
  <div class="dropdown ms-3">
   <button
    class="btn btn-light dropdown-toggle"
    type="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
   >
    Size
   </button>
   <ul class="dropdown-menu">
    <li v-for="option in sizeOptions" :key="option">
     <a
      @click="
       ((paginateObj.size = option), (paginateObj.page = 0)),
        getEvents(paginateObj)
      "
      class="dropdown-item"
      href="#"
      >{{ option }}</a
     >
    </li>
   </ul>
  </div>
  <div class="dropdown ms-3">
   <button
    class="btn btn-light dropdown-toggle"
    type="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
   >
    Go to page
   </button>
   <ul class="dropdown-menu f-height">
    <li v-for="page in NumberOfPages" :key="page">
     <a
      @click="(paginateObj.page = page - 1), getEvents(paginateObj)"
      class="dropdown-item"
      href="#"
      >{{ page }}</a
     >
    </li>
   </ul>
  </div>
 </nav>
</template>
<script setup>
import { ref } from "vue";
import { paginateObj, getEvents, NumberOfPages } from "../store/content";

let sizeOptions = ref([5, 10, 15, 20]);

function changePage(newPageNum) {
 paginateObj.page = newPageNum;
 getEvents(paginateObj);
}

function nextPage() {
 paginateObj.page = paginateObj.page + 1;
 getEvents(paginateObj);
}
function previousPage() {
 if (paginateObj.page != 0) {
  paginateObj.page = paginateObj.page - 1;
  getEvents(paginateObj);
 }
}
</script>

<style>
.dropdown-menu {
 min-width: 4rem !important;
}
.f-height {
 height: 30vh;
 overflow-y: scroll;
}
</style>
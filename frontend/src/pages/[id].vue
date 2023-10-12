<template>
  <div v-if="!SingleEventData.loader">
    <div class="container-fluid d-flex align-items-center flex-xl-wrap bg-light p-2">
      <img class="image-fluid" style="max-width: 50%;min-width: 25%;" v-if="'images' in SingleEventData.list" :src="SingleEventData.list?.images[4]?.url" alt="" />
      <div class="d-flex flex-wrap ps-5">
        <div class="p-3">
          <h2 class="fw-bolder">{{ SingleEventData.list.name }}</h2>
          <h3 class="text-muted fst-italic">{{ SingleEventData.list.id }}</h3>
          <h3 class="text-body" v-if="'classifications' in SingleEventData.list">{{ SingleEventData.list.classifications[0]?.genre?.name }} / {{ SingleEventData.list.classifications[0]?.subGenre?.name }}</h3>
          <h3 class="text-body" v-if="'classifications' in SingleEventData.list"></h3>
          <hr />
          <div v-if="'classifications' in SingleEventData.list">
            Promoters
            <h6 class="text-body" v-for="promoter in SingleEventData.list.promoters" :key="promoter">{{ promoter.name }}</h6>
          </div>
          <h5 v-if="'_embedded' in SingleEventData.list">Venue: {{ SingleEventData.list._embedded.venues[0]?.name }}, {{ SingleEventData.list._embedded.venues[0]?.city.name }}, {{ SingleEventData.list._embedded.venues[0]?.country.name }}</h5>
          <h5 v-if="'place' in SingleEventData.list">Venue: {{ SingleEventData.list.place?.address?.line1 }}, {{ SingleEventData.list.place?.city.name }}</h5>
          <h5 v-if="'_embedded' in SingleEventData.list">{{ SingleEventData.list.dates?.start?.localDate.split('-').reverse().join('.') }} - {{ SingleEventData.list.dates?.start?.localTime?.slice(0, 5) }}</h5>
          <a :href="SingleEventData.list.seatmap?.staticUrl" target="_blank"><h6>Seatmap</h6></a>
          <a v-if="SingleEventData.list.dates?.status?.code == 'onsale'" :href="SingleEventData.list.url"
            ><p class="mb-0">On Sale! (until {{ SingleEventData.list.sales?.public?.endDateTime?.slice(0, 10).split('-').reverse().join('.') }})</p></a
          >
        </div>
        <div class="p-4 text-end" v-if="SingleEventData.list.dates?.status?.code == 'onsale'">
          <a :href="SingleEventData.list?.url"><fai class="fa-4x" icon="cart-shopping"></fai></a>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-5">
      <fai class="fa-2x" icon="circle-info" v-if="SingleEventData.list.dates?.status?.code == 'onsale'"></fai>
      <h6>{{ SingleEventData.list.pleaseNote }}</h6>
      <h6>{{ SingleEventData.list.ticketLimit?.info }}</h6>
      <h6 v-if="SingleEventData.list.accessibility === null">accessibility Notes: {{ SingleEventData.list.accessibility }}</h6>
    </div>
  </div>
  <Loader v-else></Loader>

</template>
<script setup>
import { useRoute } from 'vue-router';
import { getSingleEvent, SingleEventData } from '../store/content';
import Loader from '../components/loader.vue';
const route = useRoute();
getSingleEvent(route.params.id);
</script>

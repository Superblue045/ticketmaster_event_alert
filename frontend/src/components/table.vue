<template>
  <div class="table-responsive position-relative" :class="rows.loader ? 'overflow-hidden' : ''">
    <table v-bind:style=" rows.loader ? 'filter: blur(3px)' : '' " class="table table-striped table-bordered">
      <thead>
        <tr>
          <th style="white-space: nowrap" v-for="(header, index) in headers?.list" :key="index">
            <button style="background: transparent; border: 0" @click="sortFunction(header)">{{ header }}<fai v-if="header && header != 'Type' && header != 'Status' && header != 'Zone' && header != 'Info' && header != 'Detail'" class="mx-2" icon="sort" aria-hidden="true"></fai></button>
          </th>
        </tr>
      </thead>
      <tbody class=""  >
        <tr v-for="row in rows?.list._embedded?.events" :key="row.id">
          <td>{{ row.id }}</td>
          <td>{{ row.name }}</td>
          <td v-if="!('classifications' in row)">{{ row.type }}</td>
          <td v-else>
            <span v-for="(classification, index) in row.classifications" :key="index">{{ classification.genre?.name }}<br /></span>
          </td>
          <td>{{ row.sales.public.startDateTime?.slice(0, 10).split('-').reverse().join('.') }} {{ row.sales.public.startDateTime?.slice(11, 16) }}</td>
          <td>{{ row.dates?.start?.localDate.split('-').reverse().join('.') }} {{ row.dates?.start?.localTime?.slice(0, 5) }}</td>
          <td v-if="'_embedded' in row && 'venues' in row._embedded">{{ row._embedded.venues[0]?.name }}</td>
          <td v-if="'place' in row && 'city' in row.place">{{ row.place?.city?.name }}</td>
          <td v-if="'place' in row && 'name' in row.place">{{ row.place?.name }}</td>
          <td>{{ row.dates?.status?.code }}</td>
          <td>{{ row.locale }}</td>
          <td>{{ typeof row.ticketLimit?.info == typeof '' ? toShortSentence(row.ticketLimit?.info, 60, true) : '-' }} {{ toShortSentence(row.description ? row.description : '', 60, true) }}</td>
          <td><router-link :to="`/${row.id}#${row.name}`">Detail</router-link></td>
        </tr>
      </tbody>
    </table>
    <Loader v-if="rows.loader"></Loader>
  </div>
</template>

<script setup>
import { toShortSentence } from '../lib/local';
import { headers, EventsData, sortKey, getEvents } from '../store/content';
import Loader from './loader.vue';
const props = defineProps({
  rows: Object,
});
function sortFunction(header) {
  if (header == 'Type' || header == 'Status' || header == 'Zone' || header == 'Info' || header == 'Detail') {
    return;
  }
  if (sortKey.value.includes('asc')) {
    if (header == 'ID'){
      return
    }
    if (header.split(' ').length != 1) {
      sortKey.value = header.split(' ')[1].toLowerCase() + ',desc'
    }
    else if (header == 'Venue'){
      sortKey.value = header.toLowerCase() + 'Name,desc';
    }
    else{
      sortKey.value = header.toLowerCase() + ',desc';
    }
    getEvents();
    return;
  }
  if (header == 'Venue') {
    sortKey.value = header.toLowerCase() + 'Name,asc';
  } else if (header.split(' ').length != 1) {
    sortKey.value = header.split(' ')[1].toLowerCase() + ',asc';
  } else {
    sortKey.value = header.toLowerCase() + ',asc';
  }
  getEvents();
}
</script>

<style scoped>
.blur{
  filter: blur(3px)
}
</style>

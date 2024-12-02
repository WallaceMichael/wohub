<script lang="ts">
import {defineComponent} from 'vue'
import {IonCol, IonGrid, IonImg, IonPage, IonRow, IonText} from '@ionic/vue';
import EventCard from "@/views/components/EventCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";
import CourseCard from "@/views/components/CourseCard.vue";
import api from "@/services/axios";
import {Event} from "@/models/Event";

export default defineComponent({
  name: "MyEventsPage",
  components: {
    EventCard,
    InfoHeader,
    IonGrid,
    IonText, IonRow, IonCol, IonImg,
    CourseCard,
    IonPage
  },
  data() {
    const eventsList = null;
    return {
      eventsList
    }
  },
  methods: {
    getEvents() {
      api.get('/eventos/my').then(res => {
        const events = res.data.map((eventData: any) => new Event(eventData));
        console.log(events);
        this.eventsList = events;
      }).catch(error => {
        this.eventsList = [];
        console.error("Error fetching events:", error);
      })
    }
  },
  mounted() {
    this.getEvents();
  }
})
</script>

<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Eventos" subtitle="Acompanhe seus eventos favoritos em um só lugar. Gerencie inscrições e não perca nenhuma oportunidade!" image="/woman_wearing_glasses.png" />
      <ion-row v-if="eventsList && eventsList.length > 0" style="flex-grow:1!important;">
        <div class="ion-padding ion-margin" style="flex-grow:1!important;">
          <ion-row>
            <ion-col size="12" size-sm="6" size-md="6" size-lg="3" v-for="event in eventsList" :key="event.id">
              <EventCard :event="event"/>
            </ion-col>
          </ion-row>
        </div>
      </ion-row>
      <ion-row v-else-if="eventsList && eventsList.length == 0">
        <ion-col size="12">
          <ion-text color="medium">Você não está inscrito(a) em nenhum evento!</ion-text>
        </ion-col>
      </ion-row>
    </ion-grid>
  </ion-page>
</template>

<style scoped>

</style>
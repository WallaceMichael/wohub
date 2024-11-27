<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Eventos" subtitle="Eventos legais para você" image="/woman_wearing_glasses.png" />
      <ion-row style="background: var(--ion-color-light)">
        <div class="ion-padding ion-margin">
          <ion-row>
            <ion-col size="3" v-for="event in eventsList" :key="event.id">
              <EventCard :event="event"/>
            </ion-col>
          </ion-row>
        </div>
      </ion-row>
    </ion-grid>
  </ion-page>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import {IonCol, IonGrid, IonImg, IonPage, IonRow, IonText} from '@ionic/vue';
import api from '@/services/axios';
import {Event} from "@/models/Event";
import CourseCard from "@/views/components/CourseCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";
import EventCard from "@/views/components/EventCard.vue";

export default defineComponent({
  name: "EventsPage",
  components: {
    EventCard,
    InfoHeader,
    IonGrid,
    IonText, IonRow, IonCol, IonImg,
    CourseCard,
    IonPage
  },
  data() {
    const eventsList = [];
    return {
      eventsList
    }
  },
  methods: {
    getEvents() {
      api.get('/eventos').then(res => {
        const events = res.data.map((eventData: any) => new Event(eventData));
        console.log(events);
        this.eventsList = events;
      }).catch(error => {
        console.error("Error fetching events:", error);
      })
    }
  },
  mounted() {
    this.getEvents();
  }
})
</script>


<style scoped>

</style>
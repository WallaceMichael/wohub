<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Eventos" subtitle="Eventos legais para você" image="/woman_wearing_glasses.png"/>
      <ion-row v-if="user.isCreatorType()" id="modalCreateRow" class="ion-justify-content-end">
        <ion-button class="ion-padding-vertical text-white" fill="solid" @click="setOpen(true)" expand="block">Criar
          Evento
        </ion-button>
      </ion-row>
      <ion-row>
        <div class="ion-padding ion-margin">
          <ion-row>
            <ion-col size="12" size-sm="6" size-md="6" size-lg="3" v-for="event in eventsList" :key="event.id">
              <EventCard :event="event"/>
            </ion-col>
          </ion-row>
        </div>
      </ion-row>
    </ion-grid>
    <ion-modal id="modalCreate" @didDismiss="setOpen(false)" :is-open="isModalOpen"
               style="--border-radius:10px;--max-height:80vh!important;">
      <ion-header class="ion-no-border">
        <ion-toolbar>
          <ion-title>Criar Evento</ion-title>
          <ion-buttons slot="end">
            <ion-button @click="setOpen(false)">
              <ion-icon size="large" name="close-circle-outline"></ion-icon>
            </ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-header>
      <ion-content class="ion-padding">
        <ion-list lines="none">
          <ion-item>
            <ion-input
                v-model="eventoModel.titulo"
                label="Título"
                label-placement="floating"
                type="text"
                placeholder="Digite o título do evento"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="eventoModel.descricao"
                label="Descrição"
                label-placement="floating"
                type="text"
                placeholder="Digite a descrição do evento"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="eventoModel.categoria"
                label="Categoria"
                label-placement="floating"
                type="text"
                placeholder="Digite a categoria do evento"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="eventoModel.link"
                label="Link"
                label-placement="floating"
                type="text"
                placeholder="Digite o link de inscrição/acesso ao evento"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="eventoModel.foto"
                label="Foto"
                label-placement="floating"
                type="text"
                placeholder="Digite a foto do evento"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-select v-model="eventoModel.tipo_evento" style="padding-right: 0.5em!important;" label="Tipo do evento"
                        label-placement="floating" placeholder="Digite o tipo do evento">
              <ion-select-option value="palestra">Palestra</ion-select-option>
              <ion-select-option value="workshop">Workshop</ion-select-option>
              <ion-select-option value="hackathon">Hackathon</ion-select-option>
            </ion-select>
          </ion-item>
          <br>
          <ion-item>
            <ion-input type="datetime-local" v-model="eventoModel.data_evento" label="Data do evento" label-placement="floating"
                       placeholder="Digite a data do evento"></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-button @click="onClickCreateEvent" :disabled="isCreateButtonDisabled" class="ion-padding-vertical text-white" fill="solid" expand="block"
                        style="width: 100%!important;">Criar Evento
            </ion-button>
          </ion-item>
        </ion-list>
      </ion-content>
    </ion-modal>
  </ion-page>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import {
  IonButton,
  IonButtons,
  IonCol,
  IonContent,
  IonGrid, IonHeader,
  IonImg,
  IonInput, IonItem,
  IonModal,
  IonPage,
  IonRow,
  IonText, IonTitle, IonToolbar,
  IonList, IonIcon,
  IonSelect, IonSelectOption
} from '@ionic/vue';
import api from '@/services/axios';
import {Event} from "@/models/Event";
import CourseCard from "@/views/components/CourseCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";
import EventCard from "@/views/components/EventCard.vue";
import {User} from "@/models/User";

export default defineComponent({
  name: "EventsPage",
  components: {
    IonTitle, IonHeader, IonItem, IonToolbar, IonContent, IonInput, IonModal, IonButtons,
    IonButton,
    EventCard,
    InfoHeader,
    IonGrid,
    IonText, IonRow, IonCol, IonImg,
    CourseCard,
    IonPage, IonList, IonIcon,
    IonSelect, IonSelectOption
  },
  data() {
    const eventsList = [];
    const isModalOpen = false;
    let user;
    const eventoModel = {
      titulo: "",
      descricao: "",
      categoria: "",
      link: "",
      foto: "",
      tipo_evento: "", // <--- Falta
      data_evento: "", // <--- Falta,
      usuarios_id: null,
    };
    const isCreateButtonDisabled = false;

    return {
      user,
      isCreateButtonDisabled,
      eventoModel,
      isModalOpen,
      eventsList
    }
  },
  methods: {
    onClickCreateEvent() {
      this.eventoModel.usuarios_id = this.user.id;

      if (
          !this.eventoModel.titulo ||
          !this.eventoModel.descricao ||
          !this.eventoModel.categoria ||
          !this.eventoModel.link ||
          !this.eventoModel.tipo_evento ||
          !this.eventoModel.data_evento ||
          !this.eventoModel.usuarios_id
      ) {
        alert("Todos os campos são obrigatórios.");
        return;
      }

      this.eventoModel.data_evento = this.eventoModel.data_evento.replace('T', ' ');
      console.log(this.eventoModel);
      this.isCreateButtonDisabled = true;
      this.createEvent();
    },
    createEvent() {
      api.post('/eventos', this.eventoModel).then(res => {
        console.log(res.data);
        alert("Evento criado com sucesso!");
        window.location.reload();
        this.isCreateButtonDisabled = false;
      }).catch(error => {
        console.error("Error on create a event: ", error);
        alert("Erro ao criar o evento! Por favor, tente novamente!");
        this.isCreateButtonDisabled = false;
      })
    },
    getEvents() {
      api.get('/eventos').then(res => {
        const events = res.data.map((eventData: any) => new Event(eventData));
        console.log(events);
        this.eventsList = events;
      }).catch(error => {
        console.error("Error fetching events:", error);
      })
    },
    setOpen(open: boolean) {
      this.isModalOpen = open;
    },

  },
  mounted() {
    this.getEvents();
  },
  created() {
    const user = User.getUser();
    //TODO NULL CHECK
    this.user = user;
  }
})
</script>


<style scoped>
.text-white {
  color: white;
}

#modalCreate ion-input {
  border: 1px solid #C1C7CD;
  border-radius: 8px !important;
  padding-left: 0.5em !important;
}

#modalCreate ion-select {
  border: 1px solid #C1C7CD;
  border-radius: 8px !important;
  padding-left: 0.5em !important;
}

#modalCreate .ion-no-border {
  border-bottom: 1px solid var(--ion-color-light, #f4f5f8) !important;
}
</style>
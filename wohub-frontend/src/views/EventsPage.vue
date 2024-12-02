<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Eventos"
                  subtitle="Explore eventos incríveis que conectam e capacitam mulheres na tecnologia. Participe e dê o próximo passo em sua jornada profissional!"
                  image="/woman_wearing_glasses.png"/>
      <ion-row v-if="user.isCreatorType()" id="modalCreateRow" class="ion-justify-content-between">
        <ion-col size="auto">
          <ion-button class="ion-padding-vertical text-white" fill="solid" @click="setOpen(true)" expand="block">
            Criar Evento
            <ion-icon name="add-outline" slot="start"></ion-icon>
          </ion-button>
        </ion-col>

        <ion-col size="2">
          <ion-item>
            <ion-select v-model="filtro" interface="popover" label="Filtrar" label-placement="floating">
              <ion-select-option value="all">Todos</ion-select-option>
              <ion-select-option value="hackathon">Hackathon</ion-select-option>
              <ion-select-option value="palestra">Palestra</ion-select-option>
              <ion-select-option value="workshop">Workshop</ion-select-option>
            </ion-select>
          </ion-item>
        </ion-col>

      </ion-row>
      <ion-row v-else id="modalCreateRow" class="ion-justify-content-end">
        <ion-col size="2">
          <ion-item>
            <ion-select v-model="filtro" interface="popover" label="Filtrar" label-placement="floating">
              <ion-select-option value="all">Todos</ion-select-option>
              <ion-select-option value="hackathon">Hackathon</ion-select-option>
              <ion-select-option value="palestra">Palestra</ion-select-option>
              <ion-select-option value="workshop">Workshop</ion-select-option>
            </ion-select>
          </ion-item>
        </ion-col>
      </ion-row>
      <ion-row style="flex-grow:1!important;">
        <div class="ion-padding ion-margin" style="flex-grow:1!important;">
          <ion-row>
            <ion-col size="12" size-sm="6" size-md="6" size-lg="3" v-for="event in filteredEvents" :key="event.id">
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
            <ion-select
                interface="popover"
                v-model="eventoModel.categoria"
                label="Categoria"
                label-placement="floating"
                placeholder="Selecione a categoria dos eventos"
            >
              <ion-select-option value="Desenvolvimento">Desenvolvimento</ion-select-option>
              <ion-select-option value="Inteligência Artificial">Inteligência Artificial</ion-select-option>
              <ion-select-option value="Cybersegurança">Cybersegurança</ion-select-option>
              <ion-select-option value="Data Science">Data Science</ion-select-option>
              <ion-select-option value="DevOps">DevOps</ion-select-option>
            </ion-select>
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
            <ion-select interface="popover" v-model="eventoModel.tipo_evento" style="padding-right: 0.5em!important;"
                        label="Tipo do evento"
                        label-placement="floating" placeholder="Digite o tipo do evento">
              <ion-select-option value="Palestra">Palestra</ion-select-option>
              <ion-select-option value="Workshop">Workshop</ion-select-option>
              <ion-select-option value="Hackathon">Hackathon</ion-select-option>
            </ion-select>
          </ion-item>
          <br>
          <ion-item>
            <ion-input type="datetime-local" v-model="eventoModel.data_evento" label="Data do evento"
                       label-placement="floating"
                       placeholder="Digite a data do evento"></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-button @click="onClickCreateEvent" :disabled="isCreateButtonDisabled"
                        class="ion-padding-vertical text-white" fill="solid" expand="block"
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
    const filtro = "all";
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
      filtro,
      user,
      isCreateButtonDisabled,
      eventoModel,
      isModalOpen,
      eventsList
    }
  },
  computed: {
    filteredEvents() {
      if (this.filtro === 'all') {
        return this.eventsList;
      }
      return this.eventsList.filter((event) => event.tipo_evento.toLowerCase() === this.filtro);
    },
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
      const dataModel = this.eventoModel;
      dataModel.tipo_evento = dataModel.tipo_evento.toLowerCase();
      api.post('/eventos', dataModel).then(res => {
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
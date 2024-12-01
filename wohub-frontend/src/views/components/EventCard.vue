<script lang="ts">
import {defineComponent, PropType} from 'vue'
import {
  IonCard,
  IonCardHeader,
  IonCardTitle,
  IonCardSubtitle,
  IonCardContent,
  IonLabel,
  IonText,
  IonButton,
  IonRow,
  IonCol,
  IonGrid,
  IonAvatar, IonItem, IonImg,IonIcon
} from "@ionic/vue";
import {Event} from "@/models/Event";
import api from "@/services/axios";
import {User} from "@/models/User";

export default defineComponent({
  name: "EventCard",
  components: {
    IonItem,
    IonAvatar,
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardSubtitle,
    IonCardContent,
    IonLabel,
    IonText,
    IonButton,
    IonRow,
    IonCol,
    IonGrid,
    IonImg,
    IonIcon
  },
  props: {
    event: {
      type: Object as PropType<Event>,
      required: true,
    },
  },
  data(){
    return {
      subscribeButtonDisabled: false,
    }
  },

  computed:{
    displaySubscribeButton(){
      if(this.$route.name.includes("MeusEventos")){
        return false;
      }
      return true;
    }
  },
  methods:{
    subscribe(){
      const user = User.getUser();
      const payload = {
        "user_id" : user.id,
      }

      api.post(`/eventos/subscribe/${this.$props.event.id}`, payload).then(res => {
        console.log(res);
        alert("Inscrição realizada com sucesso!");
        window.location.reload();
        this.subscribeButtonDisabled = false;
      }).catch(error => {
        console.error("Error on subscribe to an event: ", error);
        const message = error?.response?.data?.message ?? "";
        alert(`Erro ao se inscrever no evento: ${this.$props.event.titulo}. \n${message} \nPor favor, tente novamente!`);
        this.subscribeButtonDisabled = false;
      })
    }
  }
})
</script>

<template>
  <ion-card>
    <img :src="event.foto" style="height: 220px;object-fit:cover;" />
    <ion-card-header>
      <ion-card-subtitle class="text-category">{{event.data_evento}}</ion-card-subtitle>
      <ion-card-subtitle class="text-category">{{event.tipo_evento}}</ion-card-subtitle>
      <ion-card-subtitle class="text-category">{{event.categoria}}</ion-card-subtitle>
      <ion-card-title class="text-title">{{event.titulo}}</ion-card-title>
      <ion-card-subtitle class="text-description">{{event.descricao}}</ion-card-subtitle>
    </ion-card-header>

    <ion-card-content class="ion-no-padding ion-padding-vertical">
      <div slot="end" class="d-flex">
        <ion-item lines="none">
          <ion-avatar slot="start">
            <img :src="event.usuario.foto"/>
          </ion-avatar>
          <div>
            <ion-label>{{ event.usuario.nome }}</ion-label>
            <ion-label color="primary">{{ event.usuario.cargo }}</ion-label>
          </div>
        </ion-item>
      </div>
      <div class="d-flex flex-column">
        <ion-col v-if="displaySubscribeButton" size="12" class="ion-padding-horizontal ion-padding-top">
          <ion-button :disabled="subscribeButtonDisabled" @click="subscribe" fill="outline" expand="block" >Se inscrever</ion-button>
        </ion-col>
        <ion-col size="12" class="ion-padding-horizontal">
          <ion-button :href="event.link" target="_blank" fill="solid" expand="block" class="text-white">Acessar</ion-button>
        </ion-col>
      </div>
    </ion-card-content>
  </ion-card>
</template>

<style scoped>
.d-flex{
  display:flex!important;
}
.text-white{
  color:white;
  font-weight: 500;
  line-height: 17px;
}

.text-category{
  font-size: 16px;
  font-weight: 500;
  line-height: 17.6px;
  text-align: left;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.text-title{
  font-size: 20px;
  font-weight: 700;
  line-height: 22px;
  text-align: left;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.text-description{
  font-size: 16px;
  font-weight: 400;
  line-height: 22.4px;
  text-align: left;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
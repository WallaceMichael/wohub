<template class="ion-padding ion-margin">
  <ion-row class="ion-justify-content-center">
    <h2 class="which-profile-text">Qual o seu perfil?</h2>
  </ion-row>
  <ion-row class="ion-justify-content-around">
    <ion-col size="10">
      <ion-grid class="ion-text-center">
        <ion-row class="ion-margin ion-padding ion-justify-content-between">
          <ion-col size="5">
            <ion-row class="d-flex ion-justify-content-center">
              <ion-col size="12" class="ion-padding-bottom">
                <ion-img class="ion-align-self-center" src="consumer_login.png"></ion-img>
              </ion-col>
              <ion-col size="12" class="ion-padding-bottom">
                <ion-text class="type-user-text">Consumidor</ion-text>
              </ion-col>
              <ion-col size="12">
                <ion-button expand="full" style="color:white;" @click="selectProfile(1)">Criar perfil</ion-button>
              </ion-col>
            </ion-row>
          </ion-col>
          <ion-col size="5">
            <ion-row class="d-flex ion-justify-content-center">
              <ion-col size="12" class="ion-padding-bottom">
                <ion-img class="ion-align-self-center" src="creator_login.png"></ion-img>
              </ion-col>
              <ion-col size="12" class="ion-padding-bottom">
                <ion-text class="type-user-text">Criador</ion-text>
              </ion-col>
              <ion-col size="12">
                <ion-button expand="full" style="color:white;" @click="selectProfile(2)">Criar perfil</ion-button>
              </ion-col>
            </ion-row>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-col>
  </ion-row>
</template>
<script lang="ts">
import {
  IonContent,
  IonHeader,
  IonPage,
  IonTitle,
  IonToolbar,
  IonButtons,
  IonButton,
  IonImg,
  IonText,
  IonGrid,
  IonRow,
  IonCol,
  IonIcon
} from '@ionic/vue';
export default {
  components:{
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButtons,
    IonButton,
    IonImg,
    IonText,
    IonGrid,
    IonRow,
    IonCol,
    IonIcon
  },
  emits: ["profileSelected"],
  methods: {
    selectProfile(profileId: number) {
      this.$emit("profileSelected", profileId);
    }
  }
}
</script>
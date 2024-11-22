<template>
  <ion-page>
    <ion-header class="ion-no-border">
      <ion-toolbar class="ion-padding">
        <ion-buttons slot="start">
          <ion-button>
            <ion-img src="wohub_logo_complete.png" style="width: 118px;height: 31px;"></ion-img>
          </ion-button>
        </ion-buttons>
        <ion-title>
          <div class="d-flex ion-justify-content-center">
            <ion-button class="nav-menu-options" href="/home" fill="clear">Home</ion-button>
            <ion-button class="nav-menu-options" href="/resumo" fill="clear">Resumo</ion-button>
            <ion-button class="nav-menu-options" href="/contato" fill="clear">Contato</ion-button>
          </div>

        </ion-title>
        <ion-buttons slot="end">
          <ion-button router-link="/login" router-direction="forward" class="btn-border" color="primary" fill="outline" >
            <ion-text class="ion-padding">
              Login
            </ion-text></ion-button>
          <ion-button class="btn-border" color="primary" fill="solid">
            <ion-text color="light" class="ion-padding">Inscreva-se</ion-text>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>

    <ion-content :fullscreen="true" class="d-inline-flex">
      <ion-grid class="d-flex ion-align-items-center ion-justify-content-center ion-text-center" style="height: 100%;">
        <ion-row class="d-flex ion-align-items-center ion-justify-content-center">
          <ion-col>
            <ion-row>
              <ion-text style="font-size: 90px;font-weight: 700;line-height: 100px;">
                WO HUB
              </ion-text>
            </ion-row>
            <ion-row class="d-flex ion-justify-content-center">
              <ion-text style="font-size: 18px;font-weight: 400;line-height: 25px">
                Fique on-line e cresça rapidamente
              </ion-text>
            </ion-row>
          </ion-col>
          <ion-col>
            <ion-img src="frame_homepage.png" style="width: 50vw;height: 50vh;"></ion-img>
          </ion-col>
        </ion-row>
      </ion-grid>

    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
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
  IonCol
} from '@ionic/vue';
</script>

<style scoped>

.d-flex {
  display: flex !important;
}

.d-inline-flex {
  display: flex !important;
}

.nav-menu-options {
  --color: black !important;
  font-weight: 700;
}

.nav-menu-options {
  --color-activated: var(--ion-color-primary, #9747FF) !important;
}

.btn-border {
  --border-radius: 8px !important;
}

ion-toolbar{
  padding-bottom: 8px!;
}
</style>

<template>
  <ion-page>
    <ion-header class="ion-no-border">

      <ion-button color="dark" router-link="/home" router-direction="back" fill="clear">
        <ion-icon name="arrow-back-outline" class="ion-padding-end"></ion-icon>
        Voltar
      </ion-button>

    </ion-header>

    <ion-content :fullscreen="true" class="d-flex">
      <LoginProfileChooser v-if="!selectedProfile" @profileSelected="handleProfileSelected"/>
      <LoginConsumer v-else-if="selectedProfile == 1"></LoginConsumer>
      <LoginCreator v-else-if="selectedProfile == 2"></LoginCreator>


    </ion-content>
  </ion-page>
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
import LoginProfileChooser from "@/views/components/LoginProfileChooser.vue";
import LoginConsumer from "@/views/components/LoginConsumer.vue";
import LoginCreator from "@/views/components/LoginCreator.vue";

export default {
  components: {
    LoginProfileChooser,
    LoginConsumer,
    LoginCreator,
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
  props: {},
  data() {
    const selectedProfile = null;
    return {
      selectedProfile
    }
  },
  methods: {
    handleProfileSelected(profileId) {
      if (profileId === 1) {
        this.selectedProfile = profileId;
      } else if (profileId === 2) {
        this.selectedProfile = profileId;
      }
    },
  },
  created() {
    console.log(this.foo)
  }
}
</script>

<style scoped>

.d-flex {
  display: flex !important;
}

.d-inline-flex {
  display: flex !important;
}

.type-user-text {
  font-family: Roboto;
  font-size: 30px;
  font-weight: 400;
  line-height: 33px;
  text-align: center;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
}

.which-profile-text {
  font-family: Roboto;
  font-size: 42px;
  font-weight: 700;
  line-height: 46.2px;
  text-align: center;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;

}

ion-img {
  height: 400px !important;
}
</style>

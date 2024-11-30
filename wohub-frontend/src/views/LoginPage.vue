<template>
  <ion-page>
    <ion-header class="ion-no-border">

      <ion-button color="dark" @click="backToPrevious" fill="clear">
        <ion-icon name="arrow-back-outline" class="ion-padding-end"></ion-icon>
        Voltar
      </ion-button>

    </ion-header>

    <ion-content :fullscreen="true" class="d-flex">
      <LoginProfileChooser v-if="!selectedProfile" @profileSelected="handleProfileSelected"/>
      <LoginConsumer v-if="selectedProfile == 1" @loginSuccess="handleLoginSuccess"></LoginConsumer>
      <LoginCreator v-else-if="selectedProfile == 2" @loginSuccess="handleLoginSuccess"></LoginCreator>
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
    handleProfileSelected(profileId: any) {
      if (profileId === 1) {
        this.selectedProfile = profileId;
      } else if (profileId === 2) {
        this.selectedProfile = profileId;
      }
    },
    handleLoginSuccess(state: any) {
      if (state) {
        this.$router.push('/main');
        this.$nextTick(() => {
          window.location.href = '/main';
        });
      }
    },
    backToPrevious() {
      if(this.selectedProfile){
        this.selectedProfile = null;
        return;
      }else{
        this.$router.go(-1);
      }
    }
  },
  created() {
    const user = JSON.parse(localStorage.getItem("user") ?? "null");
    if (user) {
      this.$router.push('/main');
      return;
    }
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

<template>
  <ion-page>
    <ion-header class="ion-no-border">
      <ion-toolbar class="ion-padding ion-hide-md-down">
        <ion-buttons slot="start">
          <ion-img src="./wohub_logo_complete.png" style="width: 118px;height: 31px;"></ion-img>
        </ion-buttons>
        <ion-title>
          <div class="d-flex ion-justify-content-center">
            <ion-button class="nav-menu-options" href="/home" fill="clear">Home</ion-button>
            <ion-button class="nav-menu-options" href="/resumo" fill="clear">Resumo</ion-button>
            <ion-button class="nav-menu-options" color="primary" href="/contato" fill="clear">Contato</ion-button>
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
      <ion-toolbar class="ion-padding ion-show-md-down ion-hide-md-up">
        <ion-buttons slot="start">
          <ion-img src="./wohub_logo_complete.png" style="width: 118px;height: 31px;"></ion-img>
        </ion-buttons>
        <ion-title>
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
      <ion-grid class="d-flex ion-align-items-center ion-justify-content-center ion-text-center"
                style="height: 100%;background:var(--ion-color-light, #f4f5f8)!important;">
        <ion-row class="d-flex ion-align-items-center ion-justify-content-center">
          <ion-col size="12">
            <ion-text class="text-header">CONTATO</ion-text>
            <br><br><br>
            <ion-list lines="none" style="background:var(--ion-color-light, #f4f5f8)!important;">
              <ion-item style="border-radius: 20px;">
                <ion-input v-model="nome" label="Nome" label-placement="floating"
                           placeholder="Digite seu nome"></ion-input>
              </ion-item>
              <br>
              <ion-item style="border-radius: 20px;">
                <ion-input v-model="email" type="email" label="E-mail" label-placement="floating"
                           placeholder="Digite seu e-mail"></ion-input>
              </ion-item>
              <br>
              <ion-item style="border-radius: 20px;">
                <ion-textarea v-model="mensagem" label="Mensagem" label-placement="floating"
                              placeholder="Por favor, digite sua mensagem aqui..."></ion-textarea>
              </ion-item>
              <br>

              <ion-row class="ion-fixed-bottom">
                <ion-col size="12" class="ion-fixed-bottom">
                  <ion-button @click="sendContact" fill="solid" expand="block" class="text-white">Enviar</ion-button>
                </ion-col>
              </ion-row>
            </ion-list>
          </ion-col>
        </ion-row>
      </ion-grid>
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
  IonIcon,
  IonLabel,
  IonList,
  IonItem,
  IonInput,
  IonCheckbox,
  IonInputPasswordToggle,
  IonTextarea
} from '@ionic/vue';
import api from "@/services/axios";

export default {
  components: {
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
    IonIcon,
    IonLabel,
    IonList,
    IonItem,
    IonInput,
    IonCheckbox,
    IonInputPasswordToggle,
    IonTextarea
  },
  emits: ["profileSelected", "loginSuccess"],
  data() {
    const nome = "";
    const email = "";
    const mensagem = "";
    return {
      nome,
      email,
      mensagem
    }
  },
  methods: {
    sendContact() {
      api.post('/contato', {
        nome: this.nome,
        email: this.email,
        mensagem: this.mensagem,
      })
          .then((response) => {
            this.nome = "";
            this.email = "";
            this.mensagem = "";

            console.log(response);
            alert("Mensagem de contato enviada com sucesso! \nAguarde nosso retorno!");
          })
          .catch((error) => {
            console.error('Erro ao enviar o contato:', error);

            alert("Ocorreu um erro ao enviar a mensagem de contato. \nTente novamente mais tarde.");
          });
    }
  },
};
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

ion-toolbar {
  padding-bottom: 8px !important;
}

.text-header {
  font-family: Roboto;
  font-size: 91.3px;
  font-weight: 700;
  line-height: 100.43px;
  text-align: center;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
}

.text-white {
  color: white;
}
</style>

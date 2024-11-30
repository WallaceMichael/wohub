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
            <ion-button class="nav-menu-options" color="primary" href="/resumo" fill="clear">Resumo</ion-button>
            <ion-button class="nav-menu-options" href="/contato" fill="clear">Contato</ion-button>
          </div>

        </ion-title>
        <ion-buttons slot="end">
          <ion-button router-link="/login" router-direction="root" class="btn-border" color="primary" fill="outline" >
            <ion-text class="ion-padding">
              Login
            </ion-text></ion-button>
          <ion-button router-link="/cadastro" router-direction="root" class="btn-border" color="primary" fill="solid">
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
          <ion-button router-link="/login" router-direction="root" class="btn-border" color="primary" fill="outline" >
            <ion-text class="ion-padding">
              Login
            </ion-text></ion-button>
          <ion-button router-link="/cadastro" router-direction="root" class="btn-border" color="primary" fill="solid">
            <ion-text color="light" class="ion-padding">Inscreva-se</ion-text>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>

    <ion-content :fullscreen="true" class="d-inline-flex">
      <ion-grid class="d-flex ion-align-items-center ion-justify-content-center ion-text-center" style="height: 100%;background:var(--ion-color-light, #f4f5f8)!important;">
        <ion-row class="d-flex ion-align-items-center ion-justify-content-center">
          <ion-col size="10">
            <ion-col size="12">
              <ion-text class="text-header">SOBRE O PROJETO</ion-text>
            </ion-col>
            <br>
            <br>
            <br>
            <ion-col size="12">
              <ion-text class="text-resumo">
                O WO HUB é um espaço dedicado a promover o crescimento profissional de mulheres, conectando-as a
                oportunidades de capacitação nas áreas de tecnologia e engenharia. Acreditamos na força da colaboração
                feminina para alcançar a equidade no mercado de trabalho.
              </ion-text>
              <br>
              <br>
              <ion-text class="text-resumo">
                Nosso foco é oferecer minicursos, workshops e palestras que priorizam o aprendizado contínuo e prático.
                Aqui, as usuárias podem desenvolver suas habilidades e acessar conteúdos essenciais para impulsionar
                suas
                carreiras. Nosso objetivo é facilitar o acesso ao conhecimento e oportunidades, ajudando mulheres a
                avançar em setores historicamente dominados por homens.
              </ion-text>
              <br>
              <br>

              <ion-text class="text-resumo">
                Mais do que uma plataforma de capacitação, somos uma comunidade que busca ampliar a participação
                feminina
                em tecnologia. Se você quer evoluir na carreira e se conectar com outras mulheres que enfrentam os
                mesmos
                desafios e compartilham os mesmos sonhos, o WO HUB é o lugar para você.
              </ion-text>
            </ion-col>
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

.text-resumo {
  font-family: Roboto;
  font-size: 18px;
  font-weight: 400;
  line-height: 25.2px;
  text-align: center;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
  color: #21272A;
}
</style>

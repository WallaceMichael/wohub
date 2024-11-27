<template>
  <ion-page>
    <ion-split-pane when="xs" content-id="main">
      <ion-menu content-id="main">
        <ion-header class="ion-no-border">
          <ion-toolbar>
            <ion-img class="ion-justify-self-center" router-link="/main" router-direction="forward"
                     src="./wohub_logo_complete.png" style="width: 118px;height: 31px;"></ion-img>
          </ion-toolbar>
        </ion-header>
        <ion-content class="ion-padding">

          <ion-list lines="none">
            <ion-item router-link="/main">
              <ion-icon aria-hidden="true" icon="home-outline" slot="start"></ion-icon>
              <ion-label>Home</ion-label>
            </ion-item>
            <ion-item-divider></ion-item-divider>
            <ion-item router-link="/courses">
              <ion-icon aria-hidden="true" icon="albums-outline" slot="start"></ion-icon>
              <ion-label>Cursos</ion-label>
            </ion-item>
            <ion-item router-link="/events">
              <ion-icon aria-hidden="true" icon="pricetags-outline" slot="start"></ion-icon>
              <ion-label>Eventos</ion-label>
            </ion-item>
            <ion-item router-link="/articles">
              <ion-icon aria-hidden="true" icon="newspaper-outline" slot="start"></ion-icon>
              <ion-label>Artigos</ion-label>
            </ion-item>
            <ion-item-divider></ion-item-divider>
            <ion-item router-link="/my-events">
              <ion-icon aria-hidden="true" icon="people-outline" slot="start"></ion-icon>
              <ion-label>Meus eventos</ion-label>
            </ion-item>
          </ion-list>

        </ion-content>
        <ion-button router-link="/home" router-direction="forward" fill="clear">
          <ion-icon slot="start" icon="log-out-outline"></ion-icon>
          Sair
        </ion-button>
      </ion-menu>

      <div class="ion-page" id="main" style="overflow: auto">
        <ion-header class="ion-no-border">
          <ion-toolbar>
            <div slot="end" class="d-flex" style="direction: rtl!important">
              <ion-item lines="none">
                <ion-avatar slot="start">
                  <img  src="https://ionicframework.com/docs/img/demos/avatar.svg"/>
                </ion-avatar>
                <div>
                  <ion-label>Maria Joaquina</ion-label>
                  <ion-label color="primary">Front-end</ion-label>
                </div>
              </ion-item>

              <ion-item lines="none">
                <div style="background: #000;width: 1px;height: 80%;margin:auto;"></div>
              </ion-item>

              <ion-item lines="none">
                <ion-icon name="notifications" color="primary"></ion-icon>
              </ion-item>

            </div>
          </ion-toolbar>
        </ion-header>
        <ion-content>
          <ion-router-outlet/>
        </ion-content>
      </div>
    </ion-split-pane>
  </ion-page>
</template>

<script lang="ts">
import {
  IonContent,
  IonHeader,
  IonIcon,
  IonImg,
  IonMenu,
  IonPage,
  IonSplitPane,
  IonTitle,
  IonToolbar,
  IonAvatar,
  IonList,
  IonItem,
  IonItemDivider,
  IonLabel,
  IonButton,
  IonRow,
  IonText,
  IonCol,
  IonGrid,
  IonRouterOutlet
} from '@ionic/vue';
import {defineComponent} from 'vue';
import {useRoute} from 'vue-router';

export default defineComponent({
  components: {
    IonButton,
    IonIcon,
    IonImg,
    IonPage,
    IonContent,
    IonHeader,
    IonMenu,
    IonSplitPane,
    IonTitle,
    IonToolbar,
    IonAvatar,
    IonList,
    IonItem,
    IonItemDivider,
    IonLabel,
    IonRow,
    IonText,
    IonCol,
    IonGrid,
    IonRouterOutlet
  },
  setup() {
    return {};
  }
});
</script>

<style>
.d-flex {
  display: flex !important;
}

.flex-column {
  flex-direction: column;
}

.ion-justify-self-center {
  justify-self: center !important;
}

ion-item-divider {
  height: 5px !important;
  min-height: 5px !important;
}

#background_screen {
  width: 100vw;
  height: 25vh;
  background-image: url("background_screens.png");
  background-position: center;
  background-size: cover;

}

#background_screen_img {
  height: 24vh !important;
}

#background_screen_text {
  background: linear-gradient(270.03deg, rgba(242, 244, 248, 0) 0.02%, #9747FF 55.28%);
}

ion-route-outlet {
  height: 100%;
  width: 100%;
}
</style>
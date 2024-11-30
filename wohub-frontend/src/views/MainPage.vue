<template>

  <ion-split-pane when="md" content-id="main">
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
            <ion-icon icon="home-outline" slot="start"></ion-icon>
            <ion-label>Home</ion-label>
          </ion-item>
          <ion-item-divider></ion-item-divider>
          <ion-item router-link="/courses">
            <ion-icon icon="albums-outline" slot="start"></ion-icon>
            <ion-label>Cursos</ion-label>
          </ion-item>
          <ion-item router-link="/events">
            <ion-icon icon="pricetags-outline" slot="start"></ion-icon>
            <ion-label>Eventos</ion-label>
          </ion-item>
          <ion-item router-link="/articles">
            <ion-icon icon="newspaper-outline" slot="start"></ion-icon>
            <ion-label>Artigos</ion-label>
          </ion-item>
          <ion-item-divider></ion-item-divider>
          <ion-item router-link="/my-events">
            <ion-icon icon="people-outline" slot="start"></ion-icon>
            <ion-label>Meus eventos</ion-label>
          </ion-item>
        </ion-list>

        <ion-button @click="logout" fill="clear">
          <ion-icon slot="start" icon="log-out-outline"></ion-icon>
          Sair
        </ion-button>
      </ion-content>
    </ion-menu>

    <ion-page id="main" style="overflow: auto" v-if="user">
      <ion-header class="ion-no-border">
        <ion-toolbar>

          <div slot="end" class="d-flex" style="direction: rtl!important">
            <ion-item lines="none">
              <ion-avatar slot="start">
                <ion-img :src="user.foto" style="object-fit: contain!important;"/>
              </ion-avatar>
              <div>
                <ion-label>{{ user.nome }}</ion-label>
                <ion-label color="primary">{{ user.cargo }}</ion-label>
              </div>
            </ion-item>

            <ion-item lines="none">
              <div style="background: #000;width: 1px;height: 80%;margin:auto;"></div>
            </ion-item>
          </div>
          <ion-img class="ion-justify-self-center ion-hide-sm-down ion-hide-md-up" router-link="/main"
                   router-direction="forward"
                   src="./wohub_logo_complete.png" style="width: 118px;height: 31px;"></ion-img>
          <div slot="start">
            <ion-menu-button></ion-menu-button>
          </div>

        </ion-toolbar>
      </ion-header>
      <ion-content v-if="$route.name != 'Main'">
        <ion-router-outlet/>
      </ion-content>
      <ion-content v-else color="primary" class="d-flex ion-margin-auto">
        <ion-row style="height: 100%;" class="ion-justify-self-center">
          <h1 class="d-flex" style="justify-content: center;align-self: center;">O que deseja fazer hoje?</h1>
        </ion-row>
      </ion-content>
    </ion-page>
    <ion-page v-else>
      <ion-content>
        <ion-router-outlet/>
      </ion-content>
    </ion-page>
  </ion-split-pane>
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
  IonRouterOutlet,
  IonMenuToggle,
  IonMenuButton
} from '@ionic/vue';
import {defineComponent} from 'vue';
import {useRoute} from 'vue-router';
import {User} from "@/models/User";
import api from "@/services/axios";

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
    IonRouterOutlet,
    IonMenuToggle,
    IonMenuButton
  },
  data() {
    let user: User;
    return {
      user
    };
  },
  created() {
    const user = JSON.parse(localStorage.getItem("user") ?? "null");
    if (!user) {
      this.$router.push('/login');
      return;
    }

    this.user = user;
  },
  methods: {
    logout() {
      api.post('/logout').then((res) => {
        localStorage.removeItem('access_token');
        localStorage.removeItem('user');
        this.$router.push('/');
      }).catch((error) => {
        localStorage.removeItem('access_token');
        localStorage.removeItem('user');
        this.$router.push('/');
      });
    }
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
  background-image: url("/background_screens.png");
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
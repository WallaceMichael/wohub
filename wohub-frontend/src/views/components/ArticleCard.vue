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
  IonAvatar, IonItem, IonImg
} from "@ionic/vue";
import {Article} from "@/models/Article";

export default defineComponent({
  name: "ArticleCard",
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
    IonImg
  },
  props: {
    article: {
      type: Object as PropType<Article>,
      required: true,
    },
  },
})
</script>

<template>
  <ion-card>
    <ion-row>
    <ion-col size="9">
    <ion-card-header class="ion-no-padding">
      <ion-item lines="none">
        <ion-avatar slot="start">
          <img alt="Silhouette of a person's head" :src="article.usuario.foto"/>
        </ion-avatar>
        <div>
          <ion-label><b>{{ article.usuario.nome }}</b> <span style="color:var(--ion-color-primary);">Front-end</span>
          </ion-label>
        </div>
      </ion-item>
      <div class="ion-padding">
        <ion-card-subtitle><b>{{ article.categoria }}</b></ion-card-subtitle>
        <ion-card-title><b>{{ article.titulo }}</b></ion-card-title>
      </div>
    </ion-card-header>

    <ion-card-content class="ion-padding">
      <ion-text class="">
        {{ article.descricao }}
      </ion-text>

    </ion-card-content>

    <ion-row>
      <ion-col size="8">
        <ion-button fill="solid" expand="block">Acessar</ion-button>
      </ion-col>
      <ion-col size="4">
        <ion-button fill="solid" expand="block">Guardar</ion-button>
      </ion-col>
    </ion-row>
    </ion-col>
      <ion-col size="3" class="ion-align-self-center">
        <ion-img :src="article.foto"></ion-img>
      </ion-col>
    </ion-row>
  </ion-card>
</template>

<style scoped>

</style>
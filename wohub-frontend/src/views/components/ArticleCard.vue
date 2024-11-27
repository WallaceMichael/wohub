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
    IonImg,
    IonIcon
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
          <img :src="article.usuario.foto"/>
        </ion-avatar>
        <div>
          <ion-label><b>{{ article.usuario.nome }}</b> <span style="color:var(--ion-color-primary);">Front-end</span>
          </ion-label>
        </div>
      </ion-item>
      <div class="ion-padding">
        <ion-card-subtitle style="font-weight: 500;font-size: 16px;line-height: 17px;">{{ article.categoria }}</ion-card-subtitle>
        <ion-card-title style="font-size: 32px;font-weight: 700;line-height: 35px;">{{ article.titulo }}</ion-card-title>
      </div>
    </ion-card-header>

    <ion-card-content class="">
      <ion-text class="">
        {{ article.descricao }}
      </ion-text>

    </ion-card-content>

    <ion-row>
      <ion-col size="8">
        <ion-button fill="solid" expand="block"  class="text-white">Acessar</ion-button>
      </ion-col>
      <ion-col size="4">
        <ion-button fill="solid" expand="block" class="text-white">
          <slot start>
            <ion-icon name="calendar" class="ion-padding-end"></ion-icon>
          </slot>
          Guardar</ion-button>
      </ion-col>
    </ion-row>
    </ion-col>
      <ion-col size="3" class="ion-align-self-center">
        <img :src="article.foto"></img>
      </ion-col>
    </ion-row>
  </ion-card>
</template>

<style scoped>
.text-white{
  color:white;
  font-weight: 500;
  line-height: 17px;
}
</style>
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
import {Course} from "@/models/Course";

export default defineComponent({
  name: "CourseCard",
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
    course: {
      type: Object as PropType<Course>,
      required: true,
    },
  },
})
</script>

<template>
  <ion-card>
    <img :src="course.foto" style="height: 220px;object-fit:cover;" />
    <ion-card-header>
      <ion-card-subtitle class="text-category">{{course.categoria}}</ion-card-subtitle>
      <ion-card-title class="text-title">{{course.titulo}}</ion-card-title>
      <ion-card-subtitle class="text-description">{{course.descricao}}</ion-card-subtitle>
    </ion-card-header>

    <ion-card-content class="ion-no-padding ion-padding-vertical">
      <div slot="end" class="d-flex">
        <ion-item lines="none">
          <ion-avatar slot="start">
            <img :src="course.usuario.foto"/>
          </ion-avatar>
          <div>
            <ion-label>{{course.usuario.nome}}</ion-label>
            <ion-label color="primary">{{course.usuario.cargo}}</ion-label>
          </div>
        </ion-item>
      </div>
      <div class="d-flex">
        <ion-col size="12" class="ion-padding-horizontal ion-padding-top">
        <ion-button :href="course.link" target="_blank" fill="solid" expand="block" class="text-white">Acessar</ion-button>
        </ion-col>
      </div>
    </ion-card-content>
  </ion-card>
</template>

<style scoped>
.d-flex{
  display:flex!important;
}
.text-white{
  color:white;
  font-weight: 500;
  line-height: 17px;
}

.text-category{
  font-size: 16px;
  font-weight: 500;
  line-height: 17.6px;
  text-align: left;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.text-title {
  font-size: 20px;
  font-weight: 700;
  line-height: 22px;
  text-align: left;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
  display: -webkit-box;
  -webkit-line-clamp: 2; /* Limits the text to 2 lines */
  -webkit-box-orient: vertical; /* Ensures the box behaves vertically */
  overflow: hidden; /* Hides overflow text */
  text-overflow: ellipsis; /* Adds "..." to truncated text */
  max-height: calc(22px * 2); /* Enforces a maximum height of 2 lines */
  min-height: calc(22px * 2); /* Enforces a minimum height of 2 lines */
}
.text-description {
  font-size: 16px;
  font-weight: 400;
  line-height: 22.4px; /* Line height should match the line spacing */
  text-align: left;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
  display: -webkit-box;
  -webkit-line-clamp: 4; /* Restrict the content to 4 lines */
  -webkit-box-orient: vertical; /* Orient the box vertically */
  overflow: hidden; /* Hide overflowing content */
  text-overflow: ellipsis; /* Display "..." for truncated text */
  max-height: calc(22.4px * 4); /* Restrict maximum height to 4 lines */
  min-height: calc(22.4px * 4); /* Ensure minimum height is also 4 lines */
}
</style>
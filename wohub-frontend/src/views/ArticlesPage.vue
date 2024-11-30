<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Artigos" subtitle="Artigos legais para você" image="/woman_wearing_glasses.png"/>
      <ion-row>
        <div class="ion-padding ion-margin">
          <p v-for="article in articleList" :key="article.id">
            <ArticleCard :article="article" @readArticle="handleArticleModalContent"/>
          </p>
        </div>
      </ion-row>
    </ion-grid>

    <ion-modal v-if="selectedArticle" @didDismiss="setOpen(false)" :is-open="isModalOpen" style="--border-radius:10px;--max-height:50vh!important;">
      <ion-header class="ion-no-border ion-padding">
        <ion-toolbar
            style="border-bottom: 1px solid var(--ion-item-border-color, var(--ion-border-color, rgba(0, 0, 0, 0.13)));">
          <ion-title style="font-size:medium!important;">{{selectedArticle?.categoria}}</ion-title>
          <ion-title>{{selectedArticle?.titulo}}</ion-title>
          <ion-buttons slot="end">
            <ion-button @click="setOpen(false)">
              <ion-icon size="large" name="close-circle-outline"></ion-icon>
            </ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-header>
      <ion-content class="ion-padding">
        <span v-html="selectedArticle?.descricao"></span>
        <ion-row class="ion-fixed-bottom">
          <ion-col size="12"  class="ion-fixed-bottom">
            <ion-button  :href="selectedArticle.link" target="_blank" fill="solid" expand="block" class="text-white">Ir para o site do artigo!
            </ion-button>
          </ion-col>
        </ion-row>
      </ion-content>
    </ion-modal>

  </ion-page>
</template>


<script lang="ts">
import {defineComponent} from 'vue'
import {
  IonPage,
  IonHeader,
  IonToolbar,
  IonButtons,
  IonButton,
  IonTitle,
  IonContent,
  IonImg,
  IonGrid,
  IonCol,
  IonRow,
  IonText,
  IonModal,
  IonIcon
} from '@ionic/vue';
import api from "@/services/axios";
import {Article} from "@/models/Article";
import ArticleCard from "@/views/components/ArticleCard.vue";
import CourseCard from "@/views/components/CourseCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";

export default defineComponent({
  name: "ArticlesPage",
  components: {
    InfoHeader, IonIcon,
    IonText, IonRow, IonCol, IonGrid, IonImg, CourseCard,
    IonPage,
    IonHeader, IonToolbar, IonButtons, IonButton, IonTitle,
    IonContent,
    ArticleCard,
    IonModal
  },
  data() {
    const articleList = [];
    const isModalOpen = false;
    const selectedArticle: Article | null = null;
    return {
      articleList,
      isModalOpen,
      selectedArticle
    }
  },
  methods: {
    setOpen(open: boolean) {
      if (!open) {
        this.selectedArticle = null;
      }
      this.isModalOpen = open;
    },
    handleArticleModalContent(article: Article) {
      this.selectedArticle = article;
      this.setOpen(true);
    },
    getArticles() {
      api.get('/artigos')
          .then((res) => {
            const articles = res.data.map((articleData: any) => new Article(articleData));
            console.log(articles);
            this.articleList = articles;
          })
          .catch((error) => {
            console.error("Error fetching articles:", error);
          });
    }
  },
  mounted() {
    this.getArticles();
  }

});
</script>

<style scoped>
.d-flex{
  display: flex!important;
}
.text-white {
  color: white!important;
}
</style>
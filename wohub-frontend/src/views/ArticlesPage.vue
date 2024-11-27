<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Artigos" subtitle="Artigos legais para você" image="/woman_wearing_glasses.png" />
      <ion-row style="background: var(--ion-color-light)">
        <div class="ion-padding ion-margin">
          <p v-for="article in articleList" :key="article.id">
            <ArticleCard :article="article"/>
          </p>
        </div>
      </ion-row>
    </ion-grid>
  </ion-page>
</template>


<script lang="ts">
import {defineComponent} from 'vue'
import {IonPage, IonContent, IonImg, IonGrid, IonCol, IonRow, IonText} from '@ionic/vue';
import api from "@/services/axios";
import {Article} from "@/models/Article";
import ArticleCard from "@/views/components/ArticleCard.vue";
import CourseCard from "@/views/components/CourseCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";


export default defineComponent({
  name: "ArticlesPage",
  components: {
    InfoHeader,
    IonText, IonRow, IonCol, IonGrid, IonImg, CourseCard,
    IonPage,
    IonContent,
    ArticleCard
  },
  data() {
    const articleList = [];
    return {
      articleList
    }
  },
  methods: {
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

})
</script>

<style scoped>

</style>
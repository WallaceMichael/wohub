<template>
  <ion-page >
    <div class="ion-padding ion-margin">
      <p v-for="article in articleList"  :key="article.id">
        <ArticleCard  :article="article"/>
      </p>
    </div>
  </ion-page>
</template>


<script lang="ts">
import {defineComponent} from 'vue'
import {IonPage, IonContent} from '@ionic/vue';
import api from "@/services/axios";
import {Article} from "@/models/Article";
import ArticleCard from "@/views/components/ArticleCard.vue";


export default defineComponent({
  name: "ArticlesPage",
  components: {
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
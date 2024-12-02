<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Artigos" subtitle="Descubra insights e tendências do mercado de tecnologia." image="/woman_wearing_glasses.png"/>
      <ion-row v-if="user.isCreatorType()" id="modalCreateRow" class="ion-justify-content-start">
        <ion-button class="ion-padding-vertical text-white" fill="solid" @click="setOpen(true)" expand="block">
          Criar Artigo
          <ion-icon name="add-outline" slot="start"></ion-icon>
        </ion-button>
      </ion-row>
      <ion-row>
        <div class="ion-padding ion-margin">
          <p v-for="article in articleList" :key="article.id">
            <ArticleCard :article="article" @readArticle="handleArticleModalContent"/>
          </p>
        </div>
      </ion-row>
    </ion-grid>

    <ion-modal v-if="selectedArticle" @didDismiss="setArticleOpen(false)" :is-open="isModalArticleOpen" style="--border-radius:10px;--max-height:50vh!important;">
      <ion-header class="ion-no-border ion-padding">
        <ion-toolbar
            style="border-bottom: 1px solid var(--ion-item-border-color, var(--ion-border-color, rgba(0, 0, 0, 0.13)));">
          <ion-title style="font-size:medium!important;">{{selectedArticle?.categoria}}</ion-title>
          <ion-title>{{selectedArticle?.titulo}}</ion-title>
          <ion-buttons slot="end">
            <ion-button @click="setArticleOpen(false)">
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
    <ion-modal id="modalCreate" @didDismiss="setOpen(false)" :is-open="isModalOpen" style="--border-radius:10px;--max-height:80vh!important;">
      <ion-header class="ion-no-border">
        <ion-toolbar>
          <ion-title>Criar Artigo</ion-title>
          <ion-buttons slot="end">
            <ion-button @click="setOpen(false)">
              <ion-icon size="large" name="close-circle-outline"></ion-icon>
            </ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-header>
      <ion-content class="ion-padding">
        <ion-list lines="none">
          <ion-item>
            <ion-input
                v-model="artigoModel.titulo"
                label="Título"
                label-placement="floating"
                type="text"
                placeholder="Digite o título do artigo"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="artigoModel.descricao_curta"
                label="Descrição curta"
                label-placement="floating"
                type="text"
                placeholder="Digite uma breve descrição do artigo"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="artigoModel.descricao"
                label="Descrição"
                label-placement="floating"
                type="text"
                placeholder="Digite a descrição do artigo"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-select
                interface="popover"
                v-model="artigoModel.categoria"
                label="Categoria"
                label-placement="floating"
                placeholder="Selecione a categoria do artigo"
            >
              <ion-select-option value="Desenvolvimento">Desenvolvimento</ion-select-option>
              <ion-select-option value="Inteligência Artificial">Inteligência Artificial</ion-select-option>
              <ion-select-option value="Cybersegurança">Cybersegurança</ion-select-option>
              <ion-select-option value="Data Science">Data Science</ion-select-option>
              <ion-select-option value="DevOps">DevOps</ion-select-option>
            </ion-select>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="artigoModel.link"
                label="Link"
                label-placement="floating"
                type="text"
                placeholder="Digite o link de inscrição/acesso ao artigo"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="artigoModel.foto"
                label="Foto"
                label-placement="floating"
                type="text"
                placeholder="Digite a foto do artigo"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-button @click="onClickCreateArticle" :disabled="isCreateButtonDisabled" class="ion-padding-vertical text-white" fill="solid" expand="block" style="width: 100%!important;">Criar Artigo</ion-button>
          </ion-item>
        </ion-list>
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
  IonIcon, IonInput, IonItem, IonList, IonSelect, IonSelectOption
} from '@ionic/vue';
import api from "@/services/axios";
import {Article} from "@/models/Article";
import ArticleCard from "@/views/components/ArticleCard.vue";
import CourseCard from "@/views/components/CourseCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";
import {User} from "@/models/User";

export default defineComponent({
  name: "ArticlesPage",
  components: {
    IonList,
    IonItem, IonInput,
    InfoHeader, IonIcon,
    IonText, IonRow, IonCol, IonGrid, IonImg, CourseCard,
    IonPage,
    IonHeader, IonToolbar, IonButtons, IonButton, IonTitle,
    IonContent,
    ArticleCard,
    IonModal, IonSelect, IonSelectOption
  },
  data() {
    const articleList = [];
    const isModalArticleOpen = false;
    const selectedArticle: Article | null = null;
    const isModalOpen = false;
    let user;
    const artigoModel = {
      titulo: "",
      descricao_curta: "",
      descricao: "",
      categoria: "",
      link: "",
      foto: "",
      usuarios_id: null,
    };
    const isCreateButtonDisabled = false;

    return {
      user,
      isCreateButtonDisabled,
      artigoModel,
      isModalOpen,
      articleList,
      isModalArticleOpen,
      selectedArticle
    }
  },
  methods: {
    onClickCreateArticle() {
      this.artigoModel.usuarios_id = this.user.id;

      if (
          !this.artigoModel.titulo ||
          !this.artigoModel.descricao_curta ||
          !this.artigoModel.descricao ||
          !this.artigoModel.categoria ||
          !this.artigoModel.link ||
          !this.artigoModel.usuarios_id
      ) {
        alert("Todos os campos são obrigatórios.");
        return;
      }

      this.isCreateButtonDisabled = true;
      this.createArticle();
    },
    createArticle() {
      api.post('/artigos', this.artigoModel).then(res => {
        console.log(res.data);
        alert("Artigo criado com sucesso!");
        window.location.reload();
        this.isCreateButtonDisabled = false;
      }).catch(error => {
        console.error("Error on create an article: ", error);
        alert("Erro ao criar o artigo! Por favor, tente novamente!");
        this.isCreateButtonDisabled = false;
      })
    },
    setArticleOpen(open: boolean) {
      if (!open) {
        this.selectedArticle = null;
      }
      this.isModalArticleOpen = open;
    },
    handleArticleModalContent(article: Article) {
      this.selectedArticle = article;
      this.setArticleOpen(true);
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
    },
    setOpen(open: boolean) {
      this.isModalOpen = open;
    },
  },
  mounted() {
    this.getArticles();
  },
  created() {
    const user = User.getUser();
    //TODO NULL CHECK
    this.user = user;
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

#modalCreate ion-input {
  border: 1px solid #C1C7CD;
  border-radius: 8px !important;
  padding-left: 0.5em !important;
}

#modalCreate ion-select {
  border: 1px solid #C1C7CD;
  border-radius: 8px !important;
  padding-left: 0.5em !important;
}

#modalCreate .ion-no-border{
  border-bottom: 1px solid var(--ion-color-light, #f4f5f8)!important;
}
</style>
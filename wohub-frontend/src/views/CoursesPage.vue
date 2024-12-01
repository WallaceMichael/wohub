<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Cursos" subtitle="Cursos legais para você" image="/woman_wearing_glasses.png"/>
      <ion-row v-if="user.isCreatorType()" id="modalCreateRow" class="ion-justify-content-end">
        <ion-button class="ion-padding-vertical text-white" fill="solid" @click="setOpen(true)" expand="block">Criar
          Curso
        </ion-button>
      </ion-row>
      <ion-row>
        <div class="ion-padding ion-margin">
          <ion-row>
            <ion-col size="12" size-sm="6" size-md="6" size-lg="3" v-for="course in courseList" :key="course.id">
              <CourseCard :course="course"/>
            </ion-col>
          </ion-row>
        </div>
      </ion-row>
    </ion-grid>
    <ion-modal id="modalCreate" @didDismiss="setOpen(false)" :is-open="isModalOpen"
               style="--border-radius:10px;--max-height:80vh!important;">
      <ion-header class="ion-no-border">
        <ion-toolbar>
          <ion-title>Criar curso</ion-title>
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
                v-model="cursoModel.titulo"
                label="Título"
                label-placement="floating"
                type="text"
                placeholder="Digite o título do curso"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="cursoModel.descricao"
                label="Descrição"
                label-placement="floating"
                type="text"
                placeholder="Digite a descrição do curso"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="cursoModel.categoria"
                label="Categoria"
                label-placement="floating"
                type="text"
                placeholder="Digite a categoria do curso"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="cursoModel.link"
                label="Link"
                label-placement="floating"
                type="text"
                placeholder="Digite o link de inscrição/acesso ao curso"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-input
                v-model="cursoModel.foto"
                label="Foto"
                label-placement="floating"
                type="text"
                placeholder="Digite a foto do curso"
            ></ion-input>
          </ion-item>
          <br>
          <ion-item>
            <ion-button @click="onClickCreateCourse" :disabled="isCreateButtonDisabled" class="ion-padding-vertical text-white" fill="solid" expand="block"
                        style="width: 100%!important;">Criar Curso
            </ion-button>
          </ion-item>
        </ion-list>
      </ion-content>
    </ion-modal>
  </ion-page>
</template>

<script lang="ts">
import {defineComponent, ref} from 'vue'
import {
  IonCol,
  IonGrid, IonImg, IonPage, IonRow, IonText,
  IonModal, IonHeader, IonToolbar,
  IonItem, IonContent, IonTitle, IonInput, IonButtons, IonButton, IonIcon,
  IonList
} from '@ionic/vue';

import api from '@/services/axios';
import {Course} from "@/models/Course";
import CourseCard from "@/views/components/CourseCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";
import {User} from "@/models/User";

export default defineComponent({
  name: "CoursesPage",
  components: {
    IonGrid,
    IonText, IonRow, IonCol, IonImg,
    CourseCard,
    InfoHeader,
    IonPage,
    IonModal, IonHeader, IonToolbar,
    IonItem, IonContent, IonTitle, IonInput, IonButtons, IonButton, IonIcon,
    IonList
  },
  data() {
    const courseList = [];
    const isModalOpen = false;
    let user;
    const cursoModel = {
      titulo: "",
      descricao: "",
      categoria: "",
      link: "",
      foto: "",
      usuarios_id: null
    };
    const isCreateButtonDisabled = false;

    return {
      isCreateButtonDisabled,
      user,
      cursoModel,
      isModalOpen,
      courseList
    }
  },
  methods: {
    onClickCreateCourse() {
      this.cursoModel.usuarios_id = this.user.id;

      if (
          !this.cursoModel.titulo ||
          !this.cursoModel.descricao ||
          !this.cursoModel.categoria ||
          !this.cursoModel.link ||
          !this.cursoModel.usuarios_id
      ) {
        alert("Todos os campos são obrigatórios.");
        return;
      }

      this.isCreateButtonDisabled = true;
      this.createCourse();
    },
    createCourse() {
      api.post('/cursos', this.cursoModel).then(res => {
        console.log(res.data);
        alert("Curso criado com sucesso!");
        window.location.reload();
        this.isCreateButtonDisabled = false;
      }).catch(error => {
        console.error("Error on create a course: ", error);
        alert("Erro ao criar o curso! Por favor, tente novamente!");
        this.isCreateButtonDisabled = false;
      })
    },
    getCourses() {
      api.get('/cursos').then(res => {
        const courses = res.data.map((courseData: any) => new Course(courseData));
        console.log(courses);
        this.courseList = courses;
      }).catch(error => {
        console.error("Error fetching courses:", error);
      })
    },
    setOpen(open: boolean) {
      this.isModalOpen = open;
    },
  },
  mounted() {
    this.getCourses();
  },
  created() {
    const user = User.getUser();
    //TODO NULL CHECK
    this.user = user;
  }
})
</script>


<style scoped>
.text-white {
  color: white;
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

#modalCreate .ion-no-border {
  border-bottom: 1px solid var(--ion-color-light, #f4f5f8) !important;
}
</style>
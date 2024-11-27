<template>
  <ion-page>
    <ion-grid class="d-flex flex-column" style="height: 100%; overflow: auto; width:100%!important;">
      <InfoHeader title="Cursos" subtitle="Cursos legais para você" image="/woman_wearing_glasses.png" />
      <ion-row style="background: var(--ion-color-light)">
        <div class="ion-padding ion-margin">
          <ion-row>
            <ion-col size="3" v-for="course in courseList" :key="course.id">
              <CourseCard :course="course"/>
            </ion-col>
          </ion-row>
        </div>
      </ion-row>
    </ion-grid>
  </ion-page>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import {IonCol, IonGrid, IonImg, IonPage, IonRow, IonText} from '@ionic/vue';
import api from '@/services/axios';
import {Course} from "@/models/Course";
import CourseCard from "@/views/components/CourseCard.vue";
import InfoHeader from "@/views/components/InfoHeader.vue";

export default defineComponent({
  name: "CoursesPage",
  components: {
    IonGrid,
    IonText, IonRow, IonCol, IonImg,
    CourseCard,
    InfoHeader,
    IonPage
  },
  data() {
    const courseList = [];
    return {
      courseList
    }
  },
  methods: {
    getCourses() {
      api.get('/cursos').then(res => {
        const courses = res.data.map((courseData: any) => new Course(courseData));
        console.log(courses);
        this.courseList = courses;
      }).catch(error => {
        console.error("Error fetching courses:", error);
      })
    }
  },
  mounted() {
    this.getCourses();
  }
})
</script>


<style scoped>

</style>
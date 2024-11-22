<script lang="ts">
import {defineComponent} from 'vue'
import {IonPage} from '@ionic/vue';
import api from '@/services/axios';

export default defineComponent({
  name: "CoursesPage",
  components: {
    IonPage
  },
  methods:{
    getCourses(){
      api.get('/usuarios').then(res=>{
        // alert(res)
      }).catch(error=>{
        // alert("Error: "+error)
      })
    }
  },
  mounted(){
    // this.getCourses();
  }
})
</script>

<template>
  <ion-page>
    <h1>Cursos</h1>
  </ion-page>
</template>

<style scoped>

</style>
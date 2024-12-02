<script lang="ts">
import {defineComponent} from 'vue'
import {IonCol, IonImg, IonRow, IonText} from "@ionic/vue";

export default defineComponent({
  name: "InfoHeader",
  components: {IonImg, IonRow, IonCol, IonText},
  props: {
    title: {
      type: String,
      required: true,
    },
    subtitle: {
      type: String,
      default: ""
    },
    image: {
      type: String,
      required: true,
    },
  }
})
</script>

<template>
  <ion-row style="">
    <ion-col size="12" style="height: 100%">
      <ion-row>
        <div id="background_screen">
          <ion-row style="height: 100%">
            <ion-col id="background_screen_text" size="7">
              <ion-text style="color: white"><h1 style="font-size:48px!important;">{{ $props.title }}</h1></ion-text>
              <ion-text style="color: white"><h6 >{{ $props.subtitle }}</h6></ion-text>
            </ion-col>
            <ion-col size="5">
              <ion-img id="background_screen_img" :src="$props.image"></ion-img>
            </ion-col>

          </ion-row>
        </div>
      </ion-row>
    </ion-col>
  </ion-row>
</template>

<style scoped>

#background_screen {
  width: 100vw;
  height: 25vh;
  background-image: url("/background_screens.png");
  background-position: center;
  background-size: cover;

}

#background_screen_img {
  height: 24vh !important;
}

#background_screen_text {
  background: linear-gradient(270.03deg, rgba(242, 244, 248, 0) 0.02%, #9747FF 55.28%);
}
</style>
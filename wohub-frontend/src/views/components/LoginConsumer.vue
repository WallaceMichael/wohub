<template>
  <ion-row class="ion-justify-content-around" style="height: 100%;">
    <ion-col size="12" style="height: 100%;" class="ion-no-padding">
      <ion-grid class="ion-text-center ion-no-padding" style="height: 100%;">
        <ion-row class="ion-justify-content-between" style="height: 100%;">
          <ion-col id="login_vector_part" size="6" class="d-flex ion-justify-content-center ion-align-items-center">
            <ion-img src="consumer_login.png" class="" style="width: 70%;height: 50%"></ion-img>
          </ion-col>

          <ion-col id="login_form_part" size="6"
                   class="d-flex ion-justify-content-center  ion-align-self-center">
            <ion-col size="8"
                     class="flex-column">
              <ion-row>
                <ion-col size="12">
                  <ion-text class="wohub-login-name">
                    WO HUB
                  </ion-text>
                </ion-col>
                <ion-col>
                  <ion-text class="wohub-login-sub">
                    Faça login para continuar
                  </ion-text>
                </ion-col>
              </ion-row>

              <ion-row>
                <ion-list lines="none" style="width: 100%">
                  <ion-item>
                    <ion-label>
                      E-mail
                      <ion-input class="ion-padding-start"></ion-input>
                    </ion-label>


                  </ion-item>
                  <ion-item>
                    <ion-label>
                      Senha
                      <ion-input type="password" class="ion-padding-start">
                        <ion-input-password-toggle slot="end"></ion-input-password-toggle>
                      </ion-input>
                    </ion-label>
                  </ion-item>

                  <div class="d-flex ion-justify-content-between">
                    <ion-item>
                      <ion-checkbox label-placement="end" justify="start">Lembre de mim</ion-checkbox>
                    </ion-item>

                    <ion-item>
                      <a style="text-decoration: none" href="/forgot">Esqueceu sua senha?</a>
                    </ion-item>
                  </div>

                  <ion-item>
                    <ion-button router-link="/main" router-direction="forward" id="login_form_button_access" class="ion-padding-vertical" style="width: 100%"
                                expand="block">Acessar
                    </ion-button>
                  </ion-item>
                </ion-list>
              </ion-row>
              <hr style="width:80%;height: 1px; border-top: 1px solid #DDE1E6;">
              <ion-row class="ion-justify-content-center ion-margin-top">
                <a href="/signup" style="text-decoration: none">
                  <ion-text color="dark">Ainda não tem conta? Inscrever-se</ion-text>
                </a>
              </ion-row>
            </ion-col>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-col>
  </ion-row>
</template>
<script lang="ts">
import {
  IonContent,
  IonHeader,
  IonPage,
  IonTitle,
  IonToolbar,
  IonButtons,
  IonButton,
  IonImg,
  IonText,
  IonGrid,
  IonRow,
  IonCol,
  IonIcon,
  IonLabel,
  IonList,
  IonItem,
  IonInput,
  IonCheckbox,
  IonInputPasswordToggle
} from '@ionic/vue';

export default {
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButtons,
    IonButton,
    IonImg,
    IonText,
    IonGrid,
    IonRow,
    IonCol,
    IonIcon,
    IonLabel,
    IonList,
    IonItem,
    IonInput,
    IonCheckbox,
    IonInputPasswordToggle
  },
  emits: ["profileSelected"],
  methods: {
    selectProfile(profileId: number) {
      this.$emit("profileSelected", profileId);
    }
  }
}
</script>

<style scoped>
.d-flex {
  display: flex !important;
}

.flex-column {
  flex-flow: column !important;
}

body {
  overflow: none;
}

ion-content::part(scroll) {
  padding-top: var(--ion-safe-area-top, 0);
}

#login_vector_part {
  margin-left:-20px;
  background-image: url("login_vector.png");
  background-repeat: no-repeat;
  background-position-x: right !important;
}

#login_form_part {
}

ion-input {
  border: 1px solid #C1C7CD;
  border-radius: 8px !important;
}

.wohub-login-name {
  font-family: Roboto;
  font-size: 42px;
  font-weight: 700;
  line-height: 46.2px;
  text-align: center;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;
}

.wohub-login-sub {
  font-family: Roboto;
  font-size: 18px;
  font-weight: 400;
  line-height: 25.2px;
  text-align: center;
  text-underline-position: from-font;
  text-decoration-skip-ink: none;

}

#login_form_button_access {
  color: white;
}
</style>/
<template>
  <ion-page>
    <ion-header class="ion-no-border">

      <ion-button color="dark" @click="$router.push('/home')" fill="clear">
        <ion-icon name="arrow-back-outline" class="ion-padding-end"></ion-icon>
        Voltar
      </ion-button>

    </ion-header>

    <ion-content>
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
                        Crie sua conta agora!
                      </ion-text>
                    </ion-col>
                  </ion-row>

                  <ion-row>
                    <ion-list lines="none" style="width: 100%">
                      <ion-col size="12">
                        <ion-item>
                          <ion-input class="ms-2" label="Nome" label-placement="floating" v-model="nome"
                                     placeholder="Digite seu nome" required></ion-input>
                        </ion-item>
                      </ion-col>
                      <br>

                      <ion-col size="12">
                        <ion-item>
                          <ion-input class="ms-2" label="Email" label-placement="floating" v-model="email" type="email"
                                     placeholder="Digite seu email" required></ion-input>
                        </ion-item>
                      </ion-col>
                      <br>

                      <ion-col size="12">
                        <ion-item>
                          <ion-input class="ms-2" label="Senha" label-placement="floating" v-model="password"
                                     type="password" placeholder="Digite sua senha"
                                     required>
                            <ion-input-password-toggle slot="end"></ion-input-password-toggle>
                          </ion-input>
                        </ion-item>
                      </ion-col>
                      <br>

                      <ion-col size="12">
                        <ion-item>
                          <ion-input class="ms-2" label="Foto" type="text" label-placement="floating" v-model="foto"
                                     placeholder="URL da foto (opcional)"></ion-input>
                        </ion-item>
                      </ion-col>
                      <br>

                      <ion-col size="12">
                        <ion-item>
                          <ion-select class="ms-2" label="Tipo de Usuário" label-placement="floating"
                                      v-model="tipo_usuario" placeholder="Selecione o tipo de usuário">
                            <ion-select-option value="1">Consumidor</ion-select-option>
                            <ion-select-option value="2">Criador</ion-select-option>
                          </ion-select>
                        </ion-item>
                      </ion-col>
                      <br>

                      <ion-col size="12">
                        <ion-item>
                          <ion-input class="ms-2" label="Cargo" label-placement="floating" v-model="cargo"
                                     placeholder="Digite seu cargo" required></ion-input>
                        </ion-item>
                      </ion-col>
                      <br>

                      <ion-col size="12">
                        <ion-button class="text-white ion-padding-horizontal" expand="full" @click="registerUser">
                          Cadastrar
                        </ion-button>
                      </ion-col>
                      <br>
                    </ion-list>
                  </ion-row>
                  <hr style="width:80%;height: 1px; border-top: 1px solid #DDE1E6;">
                  <ion-row class="ion-justify-content-center ion-margin-top">
                    <a href="/login" style="text-decoration: none">
                      <ion-text color="dark">Já possui uma conta? Faça login!</ion-text>
                    </a>
                  </ion-row>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                </ion-col>
              </ion-col>
            </ion-row>
          </ion-grid>
        </ion-col>
      </ion-row>

    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import {
  IonContent,
  IonHeader,
  IonPage,
  IonTitle,
  IonToolbar,
  IonButton,
  IonItem,
  IonLabel,
  IonInput,
  IonGrid,
  IonRow,
  IonCol,
  IonSelect,
  IonSelectOption,
  IonIcon, IonImg, IonInputPasswordToggle, IonList, IonText
} from '@ionic/vue';
import api from '@/services/axios';

export default defineComponent({
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButton,
    IonItem,
    IonLabel,
    IonInput,
    IonGrid,
    IonRow,
    IonCol,
    IonSelect,
    IonSelectOption,
    IonIcon, IonImg, IonInputPasswordToggle, IonList, IonText
  },
  data() {
    return {
      nome: '',
      email: '',
      password: '',
      foto: '',
      tipo_usuario: '1',
      cargo: ''
    };
  },
  methods: {
    registerUser() {
      // Validando os dados
      if (!this.nome || !this.email || !this.password || !this.cargo) {
        alert('Por favor, preencha todos os campos obrigatórios.');
        return;
      }

      // Enviando os dados para a API
      api
          .post('/usuarios', {
            nome: this.nome,
            email: this.email,
            password: this.password,
            foto: this.foto,
            tipo_usuario: this.tipo_usuario,
            cargo: this.cargo
          })
          .then((response) => {
            console.log('Usuário cadastrado:', response.data);
            alert('Cadastro realizado com sucesso!');
            this.resetForm();
            this.$router.push('/login');
            this.$nextTick(() => {
              window.location.href = '/login';
            });
          })
          .catch((error) => {
            console.error('Erro ao cadastrar o usuário:', error);
            alert('Erro ao cadastrar. Tente novamente mais tarde.');
          });
    },
    resetForm() {
      this.nome = '';
      this.email = '';
      this.password = '';
      this.foto = '';
      this.tipo_usuario = 'user';
      this.cargo = '';
    }
  }
});
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
  margin-left: -20px;
  background-image: url("/login_vector.png");
  background-repeat: no-repeat;
  background-position-x: right !important;
}

#login_form_part {
}

ion-input {
  border: 1px solid #C1C7CD;
  border-radius: 8px !important;
}

ion-select {
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

.ms-2 {
  padding-left: 0.5em !important;
}

.text-white {
  color: white !important;
}
</style>

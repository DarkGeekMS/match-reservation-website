<template>
    <div class="profile-page">
        <section class="section-profile-cover section-shaped my-0">
            <div class="background-grad-5 shape shape-skew"></div>  
        </section>
        
        <section class="section">
            <div class="container">

                <card shadow class="card-profile mt--300" no-body>
                    <div class="row justify-content-center">
                        
                        <route-head title='Login'></route-head>

                        <login-form></login-form>

                    </div>
                </card>
            </div>
        </section>
    </div>
</template>
<script>
import RouteHead from './newComponents/RouteHead.vue';
import LoginForm from './newComponents/LoginForm.vue';


export default {
  components: { 
      RouteHead,
      LoginForm
  },
  data: function() {
    return{
        generateClicked: 0
      }
    },

  methods: {
    onClickGenerate (generateClicked) {
      this.generateClicked = generateClicked
      console.log(this.generateClicked)
      
    }
  }
  };
</script>
<style>
</style>

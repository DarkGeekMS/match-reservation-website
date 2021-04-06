<template>
    <div class="profile-page">
        <section class="section-profile-cover section-shaped my-0">
            <div class="background-grad-5 shape shape-skew"></div>  
        </section>
        
        <section class="section">
            <div class="container">

                <card shadow class="card-profile mt--300" no-body>
                    <div class="row justify-content-center">
                        
                        

                        <register-form></register-form>

                    </div>
                </card>
            </div>
        </section>
    </div>
</template>
<script>
import RegisterForm from './newComponents/RegisterForm.vue';


export default {
  components: { 
      RegisterForm
  },
  data: function() {
    return{
        generateClicked: 0
      }
    },

  methods: {
    onClickGenerate (generateClicked) {
      this.generateClicked = generateClicked
      
    }
  }
  };
</script>
<style>
</style>

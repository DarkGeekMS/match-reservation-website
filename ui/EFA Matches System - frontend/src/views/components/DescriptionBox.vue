
<template>
    <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                   
                    <textarea v-model="description" placeholder="Write the face description here!"></textarea>

                </div>
            </div>
        </div>
    </section>

</template>




<script>
export default {
  name: "description-box",
   props: {
    descriptionArr: Array,  
    descriptionLength: Number, 
    audioDescription: String,
    },
    watch: { 
          audioDescription(newVal, oldVal) { // watch it
            this.description = this.description + ' ' + this.audioDescription;
        }
    },
    data: function() {
    return{
        description: ''
        
      }
    },
    methods: {

  }

};
</script>


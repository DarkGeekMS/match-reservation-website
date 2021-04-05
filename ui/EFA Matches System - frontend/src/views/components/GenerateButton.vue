
<template>
    <!-- <section class="section section-components pb-0" id="section-components"> -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    
                    <!-- <base-button class="btn-3 tab6_rec" type="primary" icon="fa fa-paint-brush"  size="lg"></base-button> -->
                    <base-button type="primary" size="lg" class="btn-3 generate_button" icon="fa fa-paint-brush" :disabled="this.clicked == 1" @click="handleClick" >Generate</base-button>
                </div>
            </div>
        </div>
    <!-- </section> -->

</template>




<script>
export default {
    name: "generate-button",
    data: function() {
    return{
        clicked: 0
      }
    },
    mounted(){
        this.clicked = 0;
    },
    methods: {
        handleClick() {
            if (this.clicked == 1){
                this.clicked = 0;
            }
            else{
                this.clicked = 1;
            }
            this.$emit('clicked', this.clicked);
        }
    }
};
</script>


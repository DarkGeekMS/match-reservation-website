
<template>
    <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <img v-lazy="'img/sample.png'"
                                 class="rounded-circle img-center img-fluid shadow shadow-lg--hover"
                                 style="width: 60%;">


                    <!-- loading on face image -->
                    <div v-if="this.loading === 1">
                        <svg class="loading" width="20%"  viewBox="0 0 100 100">
                        <polyline class="line-cornered" points="0,0 100,0 100,100" stroke-width="10" fill="none"></polyline>
                        <polyline class="line-cornered" points="0,0 0,100 100,100" stroke-width="10" fill="none"></polyline>
                        <polyline class="line-cornered stroke-animation" points="0,0 100,0 100,100" stroke-width="10" fill="none"></polyline>
                        <polyline class="line-cornered stroke-animation" points="0,0 0,100 100,100" stroke-width="10" fill="none"></polyline>
                        </svg>
                    </div>

                </div>
            </div>
        </div>
    </section>

</template>




<script>
export default {
  name: "face-image",
  props: {
    loading: Number,  
    },

};
</script>
<style>
</style>

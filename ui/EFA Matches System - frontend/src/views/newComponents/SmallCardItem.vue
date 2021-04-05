
<template>
    <!-- <section class="section section-components pb-0" id="section-components"> -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 headfont">

                    <h1 :class="type">{{title}}</h1>

                </div>
            </div>
        </div>
    <!-- </section> -->

</template>




<script>
export default {
  name: "route-head",
  props: {
   title: String,
   type: String
 }

};
</script>

<style>
</style>


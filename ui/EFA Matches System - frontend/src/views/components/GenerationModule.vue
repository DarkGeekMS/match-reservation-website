<template>
    <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <headline></headline>
                    <main-menu></main-menu>







                </div>
            </div>
        </div>
    </section>

</template>
<script>
// import FaceImage from "./FaceImage";
import Headline from './Headline.vue';
import MainMenu from './MainMenu.vue';
export default {
    components: {
        // FaceImage,
        MainMenu,
        Headline
    },
  
};
</script>
<style>

</style>

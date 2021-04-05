<template>
    <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <!-- main menu -->
                    <div class='menu'>
                        <!-- main icon -->
                        <input class='toggle' id='menu' type='checkbox'>
                        <label class='style background-grad-8' for='menu'>
                            <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        </label>

                        <!-- sliders icon     -->
                        <div class='tab tab1'>
                            <router-link to="/demo" style="color:white">
                                <i class="fa fa-sliders" aria-hidden="true"></i>
                            </router-link>
                        </div>

                        <!-- mic icon -->
                        <div class='tab tab2'>
                            <router-link to="/mic" style="color:white">
                                <i class="fa fa-microphone" aria-hidden="true"></i>
                            </router-link>
                        </div>

                        <!-- text icon -->
                        <div class='tab tab3'>
                            <router-link to="/textual" style="color:white">
                                <i class="fa fa-keyboard-o" aria-hidden="true"></i>
                            </router-link>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

</template>
<script>
export default {
    name: "main-menu",

};
</script>

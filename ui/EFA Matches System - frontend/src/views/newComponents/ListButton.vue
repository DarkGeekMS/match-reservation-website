<template>
    <section class="section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    
                <div class="container2">
                    <div v-on:click="clicked" class="listbtn">{{content}}</div>
                </div>


                </div>
            </div>
        </div>
    </section>

</template>
<script>
export default {
    name: "list-button",
    props: {
        content: String,
        },
    methods: {
        clicked: function () {
            this.$emit('clicked')
        }
    }
    
};
</script>


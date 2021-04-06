<template>
    <section class="section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="select" :class=" (required&&filling_failure&&(content === head)) ?  'select-emptyfailure' : 'select' ">
                    
                    <select name="slct" id="slct" v-model="content">
                        
                        <option selected disabled>{{head}}</option>
                        <option v-for="(n, i) in items.length" :key="i" :value="{item: items[i], index: i}" >
                            {{ items[i] }}
                        </option>
                    </select>
                    </div>


                </div>
            </div>
        </div>
    </section>

</template>
<script>
export default {
    name: "drop-list",
    watch: { 
        selectedItem: {
            handler(n, o) {
                this.content = {item: (this.items[0].constructor)(n), index: this.items.indexOf( (this.items[0].constructor)(n))}
            },
            deep: true
        }
    },
    props: {
        filling_failure: Boolean,
        required: Boolean,
        head: String,
        items: Array,
        selectedItem: String
        },
    data() {
        return {
        content: this.head,
        };
    }

};
</script>


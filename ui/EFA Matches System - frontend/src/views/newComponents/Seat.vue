<template id = "temp">

    <div  @click="clicked()" v-bind:class="getClass" class="circbtn fa fa-ticket" :style="style"  > 
        {{seatWidth}}
    </div>
    
</template>
<script>
export default {
    name: "seat",
    props: {
        i:Number,
        j:Number,
        state:String,
        i_clicked:Number,
        j_clicked:Number,
        clicked_status:Number,
        seatWidth:Number

        },
 
    computed: {
        style () {
            return {
            width: Math.min((this.seatWidth * 0.8), 60) + "px",
            height: Math.min((this.seatWidth * 0.8), 60) + "px",
            margin: Math.min((this.seatWidth * 0.1), 7.5)  + "px",
            fontSize: Math.min((this.seatWidth * 0.6), 45) + "px",
            lineHeight: Math.min((this.seatWidth * 0.8), 60) + "px",
            }
        }
        ,
        getClass: function() {
            
            if(this.state === 'self'){
                return 'circbtn-self-reserved';
            }
            else if(this.state === 'other'){
                return 'circbtn-other-reserved';
            }
            return 'circbtn-not-reserved';
        }
    },


  
    methods: {
        clicked: function () {
            this.$emit('clicked', this.i , this.j)
        },
        
        
    }
    
};
</script>


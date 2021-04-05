<template>

    <div class="table-container">
    <ul class="responsive-table">
        <div  v-for="(n, i) in FirstCol.length" :key="i">
            <li class="table-row">
            <div class="col col-11">{{FirstCol[i]}}</div>
            <div class="col col-22">{{SecondCol[i]}}</div>
            </li>
        </div>

        <!-- <li class="table-row">
        <div class="col col-1" data-label="Job Id">42442</div>
        <div class="col col-2" data-label="Customer Name">Jennifer Smith</div>
        <div class="col col-3" data-label="Amount">$220</div>
        <div class="col col-4" data-label="Payment Status">Pending</div>
        </li>
        <li class="table-row">
        <div class="col col-1" data-label="Job Id">42257</div>
        <div class="col col-2" data-label="Customer Name">John Smith</div>
        <div class="col col-3" data-label="Amount">$341</div>
        <div class="col col-4" data-label="Payment Status">Pending</div>
        </li>
        <li class="table-row">
        <div class="col col-1" data-label="Job Id">42311</div>
        <div class="col col-2" data-label="Customer Name">John Carpenter</div>
        <div class="col col-3" data-label="Amount">$115</div>
        <div class="col col-4" data-label="Payment Status">Pending</div>
        </li> -->
    </ul>
    </div>
</template>
<script>
export default {
    name: "two-col-table",
    props: {
        FirstCol:Array,
        SecondCol:Array,
        
        },

    data() {
        return {
        btnClass: 'circbtn-not-reserved',
        };
    },
  
    methods: {
        clicked: function () {
            this.$emit('clicked', this.i , this.j)
        },
        
        
    }
    
};
</script>




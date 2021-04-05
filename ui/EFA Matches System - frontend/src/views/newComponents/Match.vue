<template>
    <section class="section-components pb-0" id="match" ref="match">
        <div class="container">
            <div class="row justify-content-center">
                    


                    <!-- <div style="margin-top:400px"> -->
                    
                    <!-- <card shadow class="card-profile mt--300" no-body> -->
                    
                    <div style="width: 100%; margin-left:1vw; margin-right:1vw; margin-top:5vw; ">
                    <two-col-table :FirstCol="FirstColumn" :SecondCol="SecondColumn"></two-col-table>
                    <img src="./playground.png" class="play-img-center">
                    
                    <div style="margin-bottom:1vw;">
                        <div  v-for="(n, j) in rowCount" :key="j">
                            <div style="display: flex; justify-content: center !important;">
                                <div  v-for="(n, i) in seatCount" :key="i" style="justify-content: center !important;">
                                    <seat @clicked="clicked" :i="i" :j="j" :seatWidth="seatWidth" :state="getState(i, j)"></seat>
                                </div>
                            </div>
                        </div>
                    </div>

                    <text-in v-if="userType !== 'guest' && newReservations.length > undoneReservations.length" :filling_failure="filling_failure_indicator" required placeholder="Credit Card Number *" ref="creditnumber"></text-in>
                    <text-in v-if="userType !== 'guest' && newReservations.length > undoneReservations.length" :filling_failure="filling_failure_indicator" required placeholder="Pin Number *" type="password" ref="pinnumber"></text-in>

                    <submit-button v-if="isThereReservations() || isThereUndos()  " @clicked="onClickSubmit" content="Submit"></submit-button>
                    </div>
                    <!-- </card> -->
                    <!-- </div> -->
                     
                    
            </div>
        </div>
    </section>

</template>
<script>
import Seat from './Seat.vue';
import TwoColTable from './TwoColTable.vue';
import SubmitButton from './SubmitButton.vue';
import TextIn from './TextIn.vue';
import Card from '../../components/Card.vue';
import axios from 'axios'

export default {
    name: "match",
    components:{
        Seat,
        TwoColTable,
        SubmitButton,
        TextIn,
        Card
    },
    props: {
        rowCount:Number,
        seatCount:Number,
        viewerReservations:Array,
        otherReservations:Array,
        homeTeam:String,
        awayTeam:String,
        linesman1:String,       
        linesman2:String,
        date:String,
        matchID:Number,
        referee:String,
        stadium:Number, 
        time:String,
        token:String,
        userType:String,

        },
    data() {
        return {
            FirstColumn:['Home Team', 'Away Team', 'Match Venue', 'Date', 'Time', 'Main Referee', 'Lineman #1', 'Lineman #2'],
            SecondColumn: [],
            disabled: false,
            model: 0,
            newReservations: [],
            undoneReservations: [],
            oldReservations: [],
            filling_failure_indicator: false,
            seatWidth:0,
            isMounted: false,

        };
    },
    created() {
        window.addEventListener("resize", this.myEventHandler); 
        this.isMounted = true;
        this.$nextTick(async function () {
            while(this.seatCount === 0){
                // setTimeout(() => {  console.log("World!"); }, 2000);
                await this.sleep(1);
            }
            this.seatWidth = this.$refs.match.clientWidth / this.seatCount;
            this.SecondColumn = [
                this.homeTeam,
                this.awayTeam,
                this.stadium,
                this.date,
                this.time,
                this.referee,
                this.linesman1,
                this.linesman2,
            ]
            this.oldReservations = JSON.parse(JSON.stringify(this.viewerReservations));
        })
        
    },
    destroyed() {
        window.removeEventListener("resize", this.myEventHandler);
    },
    methods: {
        sleep: function(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        },

        myEventHandler(e) {
        console.log('width',document.getElementById('match').offsetWidth)
        console.log('height',document.getElementById('match').offsetHeight)
        this.seatWidth = document.getElementById('match').offsetWidth / this.seatCount;
        console.log('width: ' + String(this.seatWidth * 0.8) + 'px; margin: ' + String(this.seatWidth * 0.1)+ 'px;');
        this.$forceUpdate();
        },

        onClickSubmit() {
            // TODO: send reserve and undo-reserve requests
            console.log(this.undoneReservations)
            console.log(this.newReservations)
            if(this.isThereReservations()){
                // TODO: send reserve request
                var i;
                for(i = 0; i < this.newReservations.length; i++){
                    this.reserveRequest(this.newReservations[i].row_number, this.newReservations[i].seat_number)
                    this.oldReservations.push(this.newReservations[i])
                    this.newReservations.splice(i, 1);
                    i--; 
                }
                alert('reservations are updated')
            }
            else if(this.newReservations.length > this.undoneReservations.length){
                var creditnumber = this.$refs.creditnumber.content;
                var pinnumber = this.$refs.pinnumber.content;
                if (creditnumber !== '' && pinnumber !== ''){
                    // TODO: send reserve request
                    var i;
                    for(i = 0; i < this.newReservations.length; i++){
                        this.reserveRequest(this.newReservations[i].row_number, this.newReservations[i].seat_number)
                        this.newReservations.splice(i, 1);
                        i--; 
                    }
                    alert('reservations are updated')
                    
                }
                else {
                    this.filling_failure_indicator = true;
                }
            }
            if(this.isThereUndos()){
                // TODO: send undo request
                var i;
                for(i = 0; i < this.undoneReservations.length; i++){
                    this.undoReserveRequest(this.undoneReservations[i].row_number, this.undoneReservations[i].seat_number)
                    this.undoneReservations.splice(i, 1);
                    i--; 
                }
                alert('some reservations are undone')
            }

            

        },

        reserveRequest: function(row,seat){
            // console.log(row,seat)
            const object = {
                token: this.token,
                match_id: this.matchID,
                seat_number: seat,
                row_number: row
            };
            axios
            .post('http://127.0.0.1:8000/api/MakeReservation', object)
            .then((response) =>{
                    console.log(response)                    
                })
            .catch(function (error) {
                    alert(error.response.data.error);
                });
        },

        undoReserveRequest: function(row,seat){
            const object = {
                token: this.token,
                match_id: this.matchID,
                seat_number: seat,
                row_number: row
            };
            axios
            .delete('http://127.0.0.1:8000/api/CancelReservation', {data: object})
            .then((response) =>{
                    console.log(response)
                })
            .catch(function (error) {
                    alert(error.response.data.error);
                });
        },

        clicked: function (i, j) {
            /*
            handles clicking on any seat(i, j)
            */
            if (this.userType !== 'guest'){
                console.log('ahooo')
                console.log(this.newReservations, this.undoneReservations)
                // handle removing a reservation
                if (this.isSelfReserved(i, j)){

                    // remove it from viewerReservations array so that the view can be updated
                    this.viewerReservations.splice(this.viewerReservations.findIndex(x => x.seat_number === i && x.row_number === j), 1);

                    // remove it from newReservations array not to send request to backend on
                    var newReservationIndex = this.newReservations.findIndex(x => x.seat_number === i && x.row_number === j);
                    if (newReservationIndex !== -1){
                        this.newReservations.splice(newReservationIndex, 1);
                    }

                    // add it to undoneReservations if it was an original one coming from database not a new one
                    var undoneReservationIndex = this.oldReservations.findIndex(x => x.seat_number === i && x.row_number === j);
                    console.log(undoneReservationIndex, this.oldReservations)
                    if (undoneReservationIndex !== -1){
                        this.undoneReservations.push(this.oldReservations[undoneReservationIndex]);
                    }
                }
                // handle a reservation
                else if (! this.isOtherReserved(i, j)){

                    // add it to viewerReservations array so that the view can be updated
                    this.viewerReservations.push({'seat_number':i,'row_number':j});

                    // add it to newReservations array to send request to backend on
                    var oldReservationIndex = this.oldReservations.findIndex(x => x.seat_number === i && x.row_number === j);
                    if (oldReservationIndex === -1){
                        this.newReservations.push({'seat_number':i,'row_number':j});
                    }
                    // remove it from undoneReservations array not to send request to backend to undo it
                    var undoneReservationIndex = this.undoneReservations.findIndex(x => x.seat_number === i && x.row_number === j);
                    if (undoneReservationIndex !== -1){
                        this.undoneReservations.splice(undoneReservationIndex, 1);
                    }
                }

                // to force update dynamic state
                this.$forceUpdate();
            }
            else{
                alert('login first')
            }

        },
        
        isSelfReserved: function(i, j){
            /*
            returns true if seat(i, j) is reserved by the viewer
            */
            for (var x = 0; x < this.viewerReservations.length; x++){
                if(this.viewerReservations[x].seat_number === i && this.viewerReservations[x].row_number === j){
                    return true;
                }
            }
            return false;
        },

        isOtherReserved: function(i, j){
            /*
            returns true if seat(i, j) is reserved by anyone except the viewer
            */
            for (var x = 0; x < this.otherReservations.length; x++){
                if(this.otherReservations[x].seat_number === i && this.otherReservations[x].row_number === j){
                    return true;
                }
            }
            return false;
        },

        getState: function(i, j){
            /*
            returns the state of seat(i, j) {free, reserved by viewer(self), reserved but not by the viewer(other)}
            */
            if (this.userType !== 'guest' && this.isSelfReserved(i, j)){
                return 'self';
            }
            
            if (this.isOtherReserved(i, j)){
                return 'other';
            }
           
            return 'free';
        },

        isThereReservations: function(){
            return this.newReservations.length !== 0;
        },
        isThereUndos: function(){
            return this.undoneReservations.length !== 0;
        },

        getClass(i, j){
            
            // if(this.isSelfReserved(i, j)){
            //     return 'circbtn-self-reserved'
            // }
            // if(this.isOtherReserved(i, j)){
            //     return 'circbtn-other-reserved'
            // }
            // return 'circbtn-not-reserved' 
            "{ 'red': group.name === 'bar' }"
            console.log({'circbtn-self-reserved': this.isSelfReserved(i, j),  
             'circbtn-other-reserved': this.isOtherReserved(i, j),
             'circbtn-not-reserved': (!this.isOtherReserved(i, j) && !this.isSelfReserved(i, j))})
            return ({'circbtn-self-reserved': this.isSelfReserved(i, j),  
             'circbtn-other-reserved': this.isOtherReserved(i, j),
             'circbtn-not-reserved': (!this.isOtherReserved(i, j) && !this.isSelfReserved(i, j))})
        // return {
        //     'fa-checkbox-marked': this.content['cravings'],  
        //     'fa-checkbox-blank-outline': !this.content['cravings']}
        }
        
    }
    
};
</script>


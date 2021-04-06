<template>
    <section class="section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <!-- <div style="margin-top: 100px;"> -->
                    <div v-on:click="clicked" class="match-card" style="width: 100%">
                        <list-button style="margin-top: 4vw;" v-if="userType === 'manager' && matchView" @clicked="matchView = false" content="Edit Match"></list-button>
                        <match :rowCount="rowCount" :seatCount="seatCount"
                            :viewerReservations="viewerReservations"
                            :otherReservations="otherReservations"
                            :homeTeam="homeTeam"
                            :awayTeam="awayTeam"
                            :linesman1="linesman1"       
                            :linesman2="linesman2"
                            :date="date"
                            :matchID="matchID"
                            :referee="referee"
                            :stadium="stadium"
                            :time="time"
                            :token="token" 
                            :userType="userType"
                            v-if="matchView"
                            ></match>
                            <edit-match v-if="!matchView"
                            :rowCount="rowCount" :seatCount="seatCount"
                            :homeTeam="homeTeam"
                            :awayTeam="awayTeam"
                            :linesman1="linesman1"       
                            :linesman2="linesman2"
                            :date="date"
                            :matchID="matchID"
                            :referee="referee"
                            :stadium="stadium"
                            :time="time"
                            :token="token" 
                            @edited="matchEdited"
                            ></edit-match>
                    </div>
                <!-- </div> -->


                </div>
            </div>
    </section>

</template>
<script>

import Match from "./Match";
import EditMatch from "./EditMatch";
import ListButton from './ListButton.vue';
import axios from 'axios'


export default {
    name: "match-card",
  components: { 
      Match,
      EditMatch,
      ListButton
  },
    props: {
      matchID: Number,
      token: String,
      userType: String,
      matchOpened: Boolean
    },
  
  // watch: { 
  //   matchOpened: function(newVal, oldVal) { // watch it
  //     if (!this.matchOpened){
  //       this.$destroy();
  //     }
  //   }
  // },
  data: function() {
    return{
        generateClicked: 0,
        seatCount: 0,
        rowCount: 0,
        otherReservations: [],
        viewerReservations:[],
        homeTeam:'',
        awayTeam:'',
        linesman1:'',
        linesman2:'',
        date:'',
        referee:'',
        stadium:0,
        time:'',
        matchView: true,
      }
    },
  mounted() {
        this.getMatchDetails()
        this.t = setInterval(() => this.pollMatchDetails(), 1000);
        // this.pollReservations()
      
    },
  destroyed() {
    clearInterval(this.t)
    },

  methods: {
    clicked (generateClicked) {
      this.generateClicked = generateClicked
      
    },
    matchEdited (home, away){
      this.getMatchDetails()      
      this.$emit('edited', home , away)
    },
    getMatchDetails(){
      var object;
      if (this.userType === 'guest'){
        object = {
          match_id: this.matchID
        };
      }
      else{
        object = {
          token: this.token,
          match_id: this.matchID
        };
      }
      var self = this
      axios
      .get('http://127.0.0.1:8000/api/MatchReservationDetails', {params: object})
      .then((response) =>{
              this.rowCount = response.data[0].stadium.rows_number
              this.seatCount = response.data[0].stadium.seats_number
              this.homeTeam = response.data[0].home_team
              this.awayTeam = response.data[0].away_team
              this.linesman1 = response.data[0].first_linesman
              this.linesman2 = response.data[0].second_linesman
              this.date = response.data[0].date
              this.matchID = response.data[0].id
              this.referee = response.data[0].main_referee
              this.stadium = response.data[0].match_venu
              this.time = response.data[0].time

              this.otherReservations = response.data[0].reservations
              if (this.userType !== 'guest'){
                this.viewerReservations = response.data[0].user_reservations
              }
              
              this.matchView = true
              this.$forceUpdate();
          })
      .catch(function (error) {
              self.$swal(error.response.data.error);
          });
    },

    pollMatchDetails(){
      var object;
      if (this.userType === 'guest'){
        object = {
          match_id: this.matchID
        };
      }
      else{
        object = {
          token: this.token,
          match_id: this.matchID
        };
      }
      var self = this
      axios
      .get('http://127.0.0.1:8000/api/MatchReservationDetails', {params: object})
      .then((response) =>{
              this.otherReservations = response.data[0].reservations
              // this.viewerReservations = response.data[0].user_reservations
              this.$forceUpdate();
          })
      .catch(function (error) {
              if(!(error.response.status === 429)){
                self.$swal(error.response.data.error);
              }
              
          });
    },
  }
  };
</script>
<style>
</style>

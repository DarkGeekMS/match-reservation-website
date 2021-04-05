<template>
    <div>
        <route-head title='Matches'></route-head>
        <div  v-for="(n, i) in matchesArray.length" :key="i" style="justify-content: center !important;">
            <match-small-card
                :homeTeam="matchesArray[i].home_team"
                :awayTeam="matchesArray[i].away_team"
                :matchID="matchesArray[i].id"
                :token="token"
                :userType="userType"
            ></match-small-card>
         </div>
        
    </div>
</template>
<script>
import MatchSmallCard from "./MatchSmallCard.vue";
import RouteHead from './RouteHead.vue';
import axios from 'axios'

export default {
  name: "matches",
  components: {
    MatchSmallCard,
    RouteHead
    },
    props:{
        token: String,
        userType: String,
    },
    data(){
        return{
            matchesArray: []
        }
    },
    created() {
        var self = this
        axios
        .get('http://127.0.0.1:8000/api/MatchsDetails')
        .then(function (response){
                console.log (response)
                self.matchesArray = response.data.matches
                // self.pendingUsers = response.data.users
            })
        .catch(function (error) {
                alert(error.response.data.error);
            });
    },
};
</script>

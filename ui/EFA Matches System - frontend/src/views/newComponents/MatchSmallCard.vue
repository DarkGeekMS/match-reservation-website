<template>
    <section class="section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <!-- <div class="col-lg-12" > -->

                <div class="match-small-card-container">
                    <div v-on:click="clicked" class="match-small-card">
                         <img :src="clubImgPath(home)" class="club-img">
                        <small-card-item title='VS' type="centerhead"></small-card-item>
                         <img :src="clubImgPath(away)" class="club-img">
                    </div>
                </div>

                <div v-if="openDetails" style=" width: 100%">
                    <match-card :key="NaN"
                        :matchID="matchID"
                        :token="token"
                        :userType="userType"
                        :matchOpened="openDetails"
                        @edited="matchEdited"
                    ></match-card>
                </div>


                <!-- </div> -->
            </div>
        </div>
    </section>

</template>
<script>
import MatchCard from './MatchCard.vue';
import SmallCardItem from './SmallCardItem.vue';

export default {
    name: "match-small-card",
    components: { 
        MatchCard,
        SmallCardItem,

    },
    created (){
        this.home = this.homeTeam
        this.away = this.awayTeam
    },
    props: {
        homeTeam: String,
        awayTeam: String,
        matchID: Number,
        token: String,
        userType: String
    },
    
    data:function(){
        return{
            openDetails: false,
            team_range: [
                'Al Ahly',
                'Zamalek SC',
                'Ismaily',
                'Tersana',
                'El Mokawloon SC',
                'El-Masry',
                'Smouha',
                'ENPPI',
                'El Ittihad El Sakndary',
                'Haras El Hodood',
                'Tanta FC',
                'Aswan FC',
                'Wadi Degla',
                'Petrojet',
                'Ittihad El Shorta',
                'Pyramids',
                'Sohag FC',
                "Tala'ea El Gaish"
            ]
        }
    },
    
    methods: {
        clicked (){
            this.openDetails = !this.openDetails;
        },
        clubImgPath (title){
            return require('./clubs/' + String(this.team_range.indexOf(title) + 1) + '.png')
        },
        matchEdited (home, away){
            this.home = home
            this.away = away
            this.$forceUpdate();
        },
    }

  
  };
</script>
<style>
</style>

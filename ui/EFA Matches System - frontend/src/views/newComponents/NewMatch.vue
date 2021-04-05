<template>
    <!-- <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12"> -->
                    <!-- <form action="/action_page.php"> -->
                    <div>
                        <route-head title='Create A Match'></route-head>
                        <div style="margin-top:30px">

                            <div class="form-group">
                                <label> Home Team *</label>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block; padding-left: 2rem" head="Home Team" :items="team_range" ref="home"></drop-list>
                            </div>

                            <div class="form-group">
                                <label> Away Team *</label>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block;  padding-left: 2.2rem" head="Away Team" :items="team_range" ref="away"></drop-list>
                            </div>

                            <div class="form-group">
                                <label> Match Venue *</label>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block; padding-left: 1.4rem" head="Match Venue" :items="stadium_range" ref="stadium"></drop-list>
                            </div>

                            <div class="form-group">
                                <label> Date *</label>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block; padding-left: 4.8rem" head="Day" :items="day_range" ref="day"></drop-list>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Month" :items="month_range" ref="month"></drop-list>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Year" :items="year_range" ref="year"></drop-list>
                            </div>

                            <div class="form-group">
                                <label> Time *</label>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block; padding-left: 4.7rem" head="Hour" :items="hour_range" ref="hour"></drop-list>
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Minute" :items="minute_range" ref="minute"></drop-list>
                            </div>


                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Main Referee *" ref="referee"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Lineman #1 *" ref="lineman1"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Lineman #2 *" ref="lineman2"></text-in>


                        <submit-button @clicked="onClickSubmit" content="Create Match"></submit-button>
                        </div>
                    <!-- </form> -->
                </div>
                <!-- </div>
            </div>
        </div>
    </section> -->

</template>
<script>
import TextIn from './TextIn.vue';
import DropList from './DropList.vue';
import SubmitButton from './SubmitButton.vue';
import RouteHead from './RouteHead.vue';

import axios from 'axios'

export default {
    name: "new-match",
    components: { 
      TextIn,
      DropList,
      SubmitButton,
      RouteHead,
    },
    data(){
        return{
            stadium_range: [],
            stadiums: []
        }
    },
    props: {
        token: String
    },

    created (){
        // TODO: send request to backend to get the available stadiums
        this.stadiums = []
        this.stadium_range = []
        const object = {
            token: this.token,
        };
        var stads = []
        axios
        .get('http://127.0.0.1:8000/api/ViewStadiums', {params: object})
        .then((response) =>{
                this.stadiums = response.data.stadiums
                
                var i;
                for (i = 0; i < this.stadiums.length; i = i+1){
                    stads.push(String(this.stadiums[i].rows_number) + '*' + String(this.stadiums[i].seats_number));
                }
                this.stadium_range = stads
                this.$forceUpdate();
            })
        .catch(function (error) {
                alert(error.response.data.error);
            });
    },
    data() {
        return {
        year_range: this.range(10, 2021),
        month_range: this.range(12, 1),
        day_range: this.range(31, 1),
        hour_range: this.range(24, 0),
        minute_range: this.range(60, 0),
        gender_range: ['Male', 'Female'],
        role_range: ['Manager', 'Fan'],

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
        ],

        filling_failure_indicator: false,
        
        };
    },
    methods: {
        range: function(size, startAt = 0) {
            return [...Array(size).keys()].map(i => i + startAt);
        },
        formatDate(day, month, year){
            var date = new Date(year, month - 1, day, 0, 0, 0, 0)
            var formatted_date = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()
            return formatted_date
        },
        formatTime(hour, minute, second){
            var date = new Date(0, 0, 0, hour, minute, 0, 0)
            var hours = String(date.getHours())
            if (hours.length === 1){
                hours = '0' + hours
            }
            var minutes = String(date.getMinutes())
            if (minutes.length === 1){
                minutes = '0' + minutes
            }
            var seconds = String(date.getSeconds())
            if (seconds.length === 1){
                seconds = '0' + seconds
            }
            var formatted_date = hours + ":" + minutes + ":" + seconds
            return formatted_date
        },
        onClickSubmit() {
            var home = this.$refs.home.content.item;
            var away = this.$refs.away.content.item;
            var stadium = this.$refs.stadium.content.index;
            var day = this.$refs.day.content.item;
            var month = this.$refs.month.content.item;
            var year = this.$refs.year.content.item;
            var hour = this.$refs.hour.content.item;
            var minute = this.$refs.minute.content.item;
            var referee = this.$refs.referee.content;
            var lineman1 = this.$refs.lineman1.content;
            var lineman2 = this.$refs.lineman2.content;
            

            if(
                !(home === 'Home Team') &&
                !(away === 'Away Team') &&
                !(this.$refs.stadium.content === 'Match Venue') &&
                !(day === 'Day') &&
                !(month === 'Month') &&
                !(year === 'Year') &&
                !(hour === 'Hour') &&
                !(minute === 'Minute') &&
                !(referee === '') &&
                !(lineman1 === '') &&
                !(lineman2 === '') 
            )
            {
                // home and away are not the same
                if (home === away){
                    alert('Home and Away Teams cannot be the same!')
                }
                // TODO: send create match request and handle error msgs back from it
                else{
                    const object = {
                        home_team: home,
                        away_team: away,
                        match_venu: this.stadiums[stadium].id,
                        main_referee: referee,
                        first_linesman: lineman1,
                        second_linesman: lineman2,
                        date: this.formatDate(day, month, year),
                        time: this.formatTime(hour, minute, 0),

                        token: this.token,

                    };
                    console.log(object)
                    var self = this
                    axios
                    .post('http://127.0.0.1:8000/api/CreateMatch', object)
                    .then(function (response){
                            console.log (response)
                        })
                    .catch(function (error) {
                            alert(error.response.data.error);
                        });
                }
            }
            else{
                this.filling_failure_indicator = true;
            }

        }
    }
};
</script>

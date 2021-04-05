<template>
    <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- <form action="/action_page.php"> -->
                        <route-head title='Edit Account'></route-head>
                        <div style="margin-top:50px">
                        <!-- <text-in :filling_failure="filling_failure_indicator" required placeholder="Username *" ref="username"></text-in> -->
                        <!-- <text-in :filling_failure="filling_failure_indicator" required type="password" placeholder="Password *" ref="password"></text-in> -->
                        First Name *
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="First Name *" ref="firstname"></text-in>
                        Last Name *
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Last Name *" ref="lastname"></text-in>
                        Email *
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Email Address *" ref="email"></text-in>
                        City *
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="City *" ref="city"></text-in>
                        Address*
                        <text-in :filling_failure="filling_failure_indicator" placeholder="Address" ref="address"></text-in>

                        <div class="form-group">
                            <label> Date of birth *</label>
                            <drop-list :filling_failure="filling_failure_indicator" :selectedItem="daySelected" required style="display:inline-block" head="Day" :items="day_range" ref="day"></drop-list>
                            <drop-list :filling_failure="filling_failure_indicator" :selectedItem="monthSelected" required style="display:inline-block" head="Month" :items="month_range" ref="month"></drop-list>
                            <drop-list :filling_failure="filling_failure_indicator" :selectedItem="yearSelected" required style="display:inline-block" head="Year" :items="year_range" ref="year"></drop-list>
                        </div>


                        <div class="form-group">
                            <label> Gender *</label>
                            <div style="display:inline-block; padding-left:2rem;">
                                <drop-list :filling_failure="filling_failure_indicator" :selectedItem="genderSelected" required head="Gender" :items="gender_range" ref="gender"></drop-list>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label> Role *</label>
                            <div style="display:inline-block; padding-left:3.15rem;">
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Role" :items="role_range" ref="role"></drop-list>
                            </div>
                        </div> -->

                        <submit-button @clicked="onClickSubmit" content="Edit Account"></submit-button>
                        </div>
                    <!-- </form> -->

                </div>
            </div>
        </div>
    </section>

</template>
<script>
import TextIn from './TextIn.vue';
import DropList from './DropList.vue';
import SubmitButton from './SubmitButton.vue';
import RouteHead from './RouteHead.vue';
import axios from 'axios'


export default {
    name: "register-form",
    components: { 
      TextIn,
      DropList,
      SubmitButton,
      RouteHead,
    },
    data() {
        return {
        year_range: this.range(115, 1900),
        month_range: this.range(12, 1),
        day_range: this.range(31, 1),
        gender_range: ['Male', 'Female'],
        role_range: ['Manager', 'Fan'],

        daySelected: '',
        yearSelected: '',
        monthSelected: '',
        genderSelected: '',

        filling_failure_indicator: false,
        
        };
    },
    props: {
        token: String,
    },
    created() {
        this.$nextTick(function () {
            const object = {
                token: this.token,
            };
            console.log(object)
            var self = this
            axios
            .get('http://127.0.0.1:8000/api/GetPreferences', {params: object})
            .then((response) =>{
                    this.$refs.firstname.content = response.data.first_name;
                    this.$refs.lastname.content = response.data.last_name;
                    this.$refs.email.content = response.data.email;
                    this.$refs.city.content = response.data.city;
                    this.$refs.address.content = response.data.address;
                    this.daySelected = String(Number(response.data.birthdate.slice(8, 10)))
                    this.monthSelected = String(Number(response.data.birthdate.slice(5, 7)))
                    this.yearSelected = String(Number(response.data.birthdate.slice(0, 4)))
                    this.genderSelected = (response.data.gender === 1) ? 'Female' : 'Male'
                    this.$forceUpdate();
                })
            .catch(function (error) {
                    alert(error.response.data.error);
                })
                ;
        })
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
        onClickSubmit() {
            // var username = this.$refs.username.content;
            // var password = this.$refs.password.content;
            var firstname = this.$refs.firstname.content;
            var lastname = this.$refs.lastname.content;
            var email = this.$refs.email.content;
            var city = this.$refs.city.content;
            var address = this.$refs.address.content;
            var day = this.$refs.day.content.item;
            var month = this.$refs.month.content.item;
            var year = this.$refs.year.content.item;
            var gender = this.$refs.gender.content.item;
            // var role = this.$refs.role.content;

            if(
                // !(username === '') &&
                // !(password === '') &&
                !(firstname === '') &&
                !(lastname === '') &&
                !(email === '') &&
                !(city === '') &&
                !(address === '') &&
                !(day === 'Day') &&
                !(month === 'Month') &&
                !(year === 'Year') &&
                !(gender === 'Gender') 
                // !(role === 'Role')                
            )
            {
                // TODO: send edit request 
                const object = {
                    token: this.token,
                    first_name: firstname,
                    last_name: lastname,
                    city: city,
                    birthdate: this.formatDate(day, month, year),
                    address: address,
                    email: email,
                    gender: (gender === 'Male') ? 0 : 1,
                };
                console.log(object)
                var self = this
                axios
                .post('http://127.0.0.1:8000/api/UpdatePreferences', object)
                .then((response) =>{
                        console.log(response)
                        alert('edited successfully!')
                    })
                .catch(function (error) {
                        alert(error.response.data.error);
                    })
                    ;
            }
            else{
                this.filling_failure_indicator = true;
            }

        }
    }
};
</script>

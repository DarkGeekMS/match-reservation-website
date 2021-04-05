<template>
    <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- <form action="/action_page.php"> -->
                        <route-head title='Sign Up'></route-head>
                        <div style="margin-top:50px">
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Username *" ref="username"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required type="password" placeholder="Password *" ref="password"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="First Name *" ref="firstname"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Last Name *" ref="lastname"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Email Address *" ref="email"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required placeholder="City *" ref="city"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" placeholder="Address" ref="address"></text-in>

                        <div class="form-group">
                            <label> Date of birth *</label>
                            <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Day" :items="day_range" ref="day"></drop-list>
                            <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Month" :items="month_range" ref="month"></drop-list>
                            <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Year" :items="year_range" ref="year"></drop-list>
                        </div>


                        <div class="form-group">
                            <label> Gender *</label>
                            <div style="display:inline-block; padding-left:2rem;">
                                <drop-list :filling_failure="filling_failure_indicator" required head="Gender" :items="gender_range" ref="gender"></drop-list>
                            </div>
                        </div>

                        <div class="form-group">
                            <label> Role *</label>
                            <div style="display:inline-block; padding-left:3.15rem;">
                                <drop-list :filling_failure="filling_failure_indicator" required style="display:inline-block" head="Role" :items="role_range" ref="role"></drop-list>
                            </div>
                        </div>

                        <submit-button @clicked="onClickSubmit" content="Sign Up"></submit-button>
                        </div>
                    <!-- </form> -->

                </div>
            </div>
        </div>
    </section>

</template>
<script>
import axios from 'axios'

import TextIn from './TextIn.vue';
import DropList from './DropList.vue';
import SubmitButton from './SubmitButton.vue';
import RouteHead from './RouteHead.vue';

import Router from "vue-router";
import Vue from "vue";
Vue.use(Router);

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
        onClickSubmit() {
            var username = this.$refs.username.content;
            var password = this.$refs.password.content;
            var firstname = this.$refs.firstname.content;
            var lastname = this.$refs.lastname.content;
            var email = this.$refs.email.content;
            var city = this.$refs.city.content;
            var address = this.$refs.address.content;
            var day = this.$refs.day.content.item;
            var month = this.$refs.month.content.item;
            var year = this.$refs.year.content.item;
            var gender = this.$refs.gender.content.item;
            var role = this.$refs.role.content.item;
            var self = this
            console.log(this.$refs.month.content)
            if(
                !(username === '') &&
                !(password === '') &&
                !(firstname === '') &&
                !(lastname === '') &&
                !(email === '') &&
                !(city === '') &&
                !(day === 'Day') &&
                !(month === 'Month') &&
                !(year === 'Year') &&
                !(gender === 'Gender') &&
                !(role === 'Role')                
            )
            {
                // TODO: send register request and handle error msgs back from it
                const object = {
                    username: username,
                    password: password,
                    first_name: firstname,
                    last_name: lastname,
                    email:email,
                    city: city,
                    address: address,
                    gender: (gender === 'Male') ? 0 : 1,
                    role: (role === 'Manager') ? 2 : 1,
                    birthdate: this.formatDate(day, month, year),
                };
                console.log(object)
                axios
                .post('http://127.0.0.1:8000/api/SignUp', object)
                .then(function (response){
                    alert(response.data);
                    self.$router.push('/')
                    })
                .catch(function (error) {
                    alert(error.response.data.error);
                    });
            }
            else{
                this.filling_failure_indicator = true;
            }

        }
    }
};
</script>

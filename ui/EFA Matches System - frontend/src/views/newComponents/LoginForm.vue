<template>
    <section class="section section-components pb-0" id="section-components">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- <form action="/action_page.php"> -->

                        <text-in :filling_failure="filling_failure_indicator" required placeholder="Username *" ref="username"></text-in>
                        <text-in :filling_failure="filling_failure_indicator" required type="password" placeholder="Password *" ref="password"></text-in>
                        
                        <submit-button @clicked="onClickSubmit" content="Login"></submit-button>
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


export default {
    name: "login-form",
    components: { 
      TextIn,
      DropList,
      SubmitButton
    },
    data() {
        return {
        filling_failure_indicator: false,
        };
    },
    methods: {
        range: function(size, startAt = 0) {
            return [...Array(size).keys()].map(i => i + startAt);
        },
        onClickSubmit() {
            var username = this.$refs.username.content;
            var password = this.$refs.password.content;
            var self = this
            if(
                !(username === '') &&
                !(password === '')              
            )
            {
                // TODO: send register request and handle error msgs back from it
                const object = {
                    username: username,
                    password: password,
                };
                axios
                .post('http://127.0.0.1:8000/api/SignIn', object)
                .then(function (response){
                    var type = '';
                    if (response.data.role === 3){
                        type = 'admin'
                    }
                    else if (response.data.role === 2){
                        type = 'manager'
                    }
                    else if (response.data.role === 1){
                        type = 'fan'
                    }
                    
                    self.$router.push({name:'components', params: { userType: type , token: response.data.token}})
                    })
                .catch(function (error) {
                    self.$swal(error.response.data.error);
                    });
            }
            else{
                this.filling_failure_indicator = true;
            }

        }
    }
};
</script>

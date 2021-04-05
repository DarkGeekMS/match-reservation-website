<template>
    <div>
        <route-head title='Remove Users'></route-head>
        <div style="margin-top: 30px">
        <div  v-for="(n, i) in currentUsers.length" :key="i" style="justify-content: center !important;">
            <remove-single-user
                :userID="currentUsers[i].id"
                :userName="currentUsers[i].username"
                :token="token"
            ></remove-single-user>
        </div>
        </div>
    </div>
</template>
<script>
import RemoveSingleUser from './RemoveSingleUser.vue';
import RouteHead from './RouteHead.vue';
import axios from 'axios'

export default {
    name: "remove-users",
    components: {
        RemoveSingleUser,
        RouteHead
    },
    props: {
        token: String
    },
    data () {
        return{
            currentUsers: []
        }
    },
    created (){
        // TODO: send request to backend to get the all current users
        const object = {
            token: this.token,
        };
        var self = this
        axios
        .get('http://127.0.0.1:8000/api/GetUsers', {params: object})
        .then(function (response){
                console.log (response);
                self.currentUsers = response.data.users
            })
        .catch(function (error) {
                alert(error.response.data.error);
            });


        // this is dummy to be removed
        // this.currentUsers = [
        //     {
        //         userid: '1',
        //         username: 'Mohamed Ahmed'
        //     },
        //     {
        //         userid: '2',
        //         username: 'Mohamed Shawky'
        //     },
        //     {
        //         userid: '3',
        //         username: 'Monda Talaat'
        //     },
        //     {
        //         userid: '4',
        //         username: 'Mohamed Ramzy'
        //     }
        // ]
    },
    
};
</script>

<template>
    <div>
        <route-head title='Approve Users'></route-head>
        <div style="margin-top: 30px">
        <div  v-for="(n, i) in pendingUsers.length" :key="i" style="justify-content: center !important;">
            <approve-single-user
                :userID="pendingUsers[i].id"
                :userName="pendingUsers[i].username"
                :token="token"
            ></approve-single-user>
        </div>
        </div>
    </div>
</template>
<script>
import ApproveSingleUser from './ApproveSingleUser.vue';
import RouteHead from './RouteHead.vue';
import axios from 'axios'

export default {
    name: "approve-users",
    data () {
        return{
            pendingUsers: []
        }
    },
    props: {
        token: String
    },
    components: {
        ApproveSingleUser,
        RouteHead
    },
    created (){
        // TODO: send request to backend to get the all pending users
        const object = {
            token: this.token,
        };
        var self = this
        axios
        .get('http://127.0.0.1:8000/api/GetWaittingUsers', {params: object})
        .then(function (response){
                console.log (response)
                self.pendingUsers = response.data.users

            })
        .catch(function (error) {
                alert(error.response.data.error);
            });
    },
    
};
</script>

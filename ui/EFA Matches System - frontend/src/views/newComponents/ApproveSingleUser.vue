<template>
    <div v-if="!approved">
        <div class="responsive-table">
            <div class="table-row" style="align-items: center">
                <div class="col col-1-big">{{userName}}</div>
                <div class="circbtn fa fa-check circbtn-check" @click="onClickApproveUser"></div>
            </div>
        </div>
    </div>
</template>
<script>
import ListButton from './ListButton.vue';
import axios from 'axios'

export default {
    name: "approve-single-user",
    components: {
        ListButton,
    },
    data (){
        return{
            approved: false
        }
    },
    props: {
        userID: Number,
        userName: String,
        token: String
    },

    methods: {
        onClickApproveUser: function () {
            // TODO: send request to backend to approve userid
            const object = {
                token: this.token,
                user_id: this.userID
            };
            var self = this
            axios
            .post('http://127.0.0.1:8000/api/ApproveUser', object)
            .then(function (response){
                    console.log (response)
                    self.approved = true;
                })
            .catch(function (error) {
                    alert(error.response.data.error);
                });
        },
    }
};
</script>

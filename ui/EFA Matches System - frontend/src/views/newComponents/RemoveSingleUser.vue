<template>
    <div v-if="!removed">
        <div class="responsive-table">
            <div class="table-row" style="align-items: center">
                <div class="col col-1-big">{{userName}}</div>
                <div class="circbtn fa fa-remove circbtn-cross" @click="onClickRemoveUser"></div>
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
            removed: false
        }
    },
    props: {
        userID: Number,
        userName: String,
        token: String
    },

    methods: {
        onClickRemoveUser: function () {
            // TODO: send request to backend to approve userid
            const object = {
                token: this.token,
                user_id: this.userID
            };
            var self = this
            axios
            .delete('http://127.0.0.1:8000/api/DeleteUser', {data: object})
            .then(function (response){
                    console.log (response)
                    self.removed = true;
                })
            .catch(function (error) {
                    alert(error.response.data.error);
                });
        },
    }
};
</script>

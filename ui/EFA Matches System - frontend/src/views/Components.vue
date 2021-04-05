<template>
    <div>
        <hero></hero>
        
        <div style="margin-left: 4%; margin-right: 4%">

        <!-- right elements -->
        <div style="width:80%; float: right; padding-left: 4%; padding-right: 4%">
            <matches :token="token" :userType="userType" v-if="viewMatches"></matches>
            <new-stadium :token="token" v-if="newStadium"></new-stadium>
            <new-match :token="token" v-if="newMatch"></new-match>
            <approve-users :token="token" v-if="approveUsers"></approve-users>
            <remove-users :token="token" v-if="removeUsers"></remove-users>
            <edit-account :token="token" v-if="editAccount"></edit-account>
            <div style="text-align: center; margin-bottom: 20vw; margin-top: 20vw"
            v-if="!viewMatches && !newStadium && !newMatch && !approveUsers && !removeUsers && !editAccount"
            >
                <img src="./newComponents/logo2.png" style="width: 300px; text-align: center;" class="img-fluid" >
            </div>
        </div>
       
        <!-- left list -->
        <div style="width:20%; float: left; margin-top:10vw; margin-bottom: 40vw;">

            <guest-list 
            @viewMatchesClicked="onClickViewMatches" 
            v-if="userType === 'guest'">
            </guest-list>

            <fan-list 
            @viewMatchesClicked="onClickViewMatches" 
            @editAccountClicked="onClickEditAccount"  
            v-if="userType === 'fan'">
            </fan-list>

            <manager-list 
            @viewMatchesClicked="onClickViewMatches" 
            @newMatchClicked="onClickNewMatch"  
            @newStadiumClicked="onClickNewStadium"  
            v-if="userType === 'manager'">
            </manager-list>

            <admin-list 
            @approveUsersClicked="onClickApproveUsers" 
            @removeUsersClicked="onClickRemoveUsers"  
            v-if="userType === 'admin'">
            </admin-list>

        </div>
        </div>
    </div>
</template>
<script>

import Hero from "./newComponents/Hero";
import Matches from "./newComponents/Matches.vue";
import NewStadium from "./newComponents/NewStadium.vue";
import NewMatch from "./newComponents/NewMatch.vue";
import ApproveUsers from "./newComponents/ApproveUsers.vue"
import RemoveUsers from "./newComponents/RemoveUsers.vue"
import EditAccount from "./newComponents/EditAccount.vue"
import GuestList from "./newComponents/GuestList";
import FanList from "./newComponents/FanList";
import ManagerList from "./newComponents/ManagerList";
import AdminList from "./newComponents/AdminList";

export default {
  name: "components",
  data(){
      return{
          viewMatches: false,
          editAccount: false,
          newMatch: false,
          newStadium: false,
          approveUsers: false,
          removeUsers: false,
      }
  },
  props:{
    userType: {
        type: String,
        default: 'guest'
        },
    token: {
        type: String,
        default: ''
        }
  },
  methods:{
        onClickViewMatches: function () {
            this.viewMatches=true;
            this.editAccount= false;
            this.newMatch= false;
            this.newStadium= false;
            this.approveUsers= false;
            this.removeUsers= false;
        },
        onClickEditAccount: function () {
            this.viewMatches=false;
            this.editAccount= true;
            this.newMatch= false;
            this.newStadium= false;
            this.approveUsers= false;
            this.removeUsers= false;
        },
        onClickNewMatch: function () {
            this.viewMatches=false;
            this.editAccount= false;
            this.newMatch= true;
            this.newStadium= false;
            this.approveUsers= false;
            this.removeUsers= false;
        },
        onClickNewStadium: function () {
            this.viewMatches=false;
            this.editAccount= false;
            this.newMatch= false;
            this.newStadium= true;
            this.approveUsers= false;
            this.removeUsers= false;
        },
        onClickApproveUsers: function () {
            this.viewMatches=false;
            this.editAccount= false;
            this.newMatch= false;
            this.newStadium= false;
            this.approveUsers= true;
            this.removeUsers= false;
        },
        onClickRemoveUsers: function () {
            this.viewMatches=false;
            this.editAccount= false;
            this.newMatch= false;
            this.newStadium= false;
            this.approveUsers= false;
            this.removeUsers= true;
        },
  },

  components: {
    Hero,
    Matches,
    NewStadium,
    NewMatch,
    ApproveUsers,
    RemoveUsers,
    EditAccount,
    GuestList,
    FanList,
    ManagerList,
    AdminList,
    },

};
</script>

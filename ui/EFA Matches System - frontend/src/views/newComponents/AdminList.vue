<template>
    <div style="margin-top:30px">

        <list-button @clicked="onClickApproveUsers" content="Approve New Users"></list-button>        
        <list-button @clicked="onClickRemoveUsers" content="Remove Existing Users"></list-button>             
        
    </div>
</template>
<script>
import ListButton from './ListButton.vue';

export default {
    name: "admin-list",
    components: {
        ListButton,
    },

    methods: {
        onClickApproveUsers: function () {
            this.$emit('approveUsersClicked')
        },
        onClickRemoveUsers: function () {
            this.$emit('removeUsersClicked')
        },
    }
};
</script>

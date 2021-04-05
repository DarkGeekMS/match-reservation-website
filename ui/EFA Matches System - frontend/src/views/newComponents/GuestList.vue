<template>
    <div style="margin-top:30px">

        <list-button @clicked="$router.push('login')" content="Login"></list-button>
        <list-button @clicked="$router.push('register')" content="Sign Up"></list-button>
        <list-button @clicked="onClickViewMatches" content="View Matches"></list-button>        
        
    </div>
</template>
<script>
import ListButton from './ListButton.vue';

export default {
    name: "guest-list",
    components: {
        ListButton,
    },

    methods: {
        onClickViewMatches: function () {
            this.$emit('viewMatchesClicked')
        },

    }
};
</script>

<template>
    <div style="margin-top:30px">

        <list-button @clicked="onClickNewMatch" content="Create A New Match"></list-button>        
        <list-button @clicked="onClickNewStadium" content="Create A New Stadium"></list-button>             
        <list-button @clicked="onClickViewMatches" content="View Matches"></list-button>        
        
    </div>
</template>
<script>
import ListButton from './ListButton.vue';

export default {
    name: "manager-list",
    components: {
        ListButton,
    },

    methods: {
        onClickViewMatches: function () {
            this.$emit('viewMatchesClicked')
        },
        onClickNewMatch: function () {
            this.$emit('newMatchClicked')
        },
        onClickNewStadium: function () {
            this.$emit('newStadiumClicked')
        },
    }
};
</script>

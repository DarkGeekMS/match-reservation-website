<template>
    <div style="margin-top:30px">

        <list-button @clicked="onClickEditAccount" content="Edit Account"></list-button>        
        <list-button @clicked="onClickViewMatches" content="View Matches"></list-button>        
        
    </div>
</template>
<script>
import ListButton from './ListButton.vue';

export default {
    name: "fan-list",
    components: {
        ListButton,
    },

    methods: {
        onClickViewMatches: function () {
            this.$emit('viewMatchesClicked')
        },
        onClickEditAccount: function () {
            this.$emit('editAccountClicked')
        },

    }
};
</script>

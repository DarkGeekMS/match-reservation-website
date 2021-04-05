<template>
    <div>
        <route-head title='Create A Stadium'></route-head>
        <div style="margin-top: 30px">
        <text-in :filling_failure="filling_failure_indicator" required placeholder="number of rows *" ref="rowsCount"></text-in>
        <text-in :filling_failure="filling_failure_indicator" required placeholder="number of seats per row *" ref="seatCount"></text-in>
        <submit-button @clicked="onClickSubmit" content="Create"></submit-button>
        </div>
    </div>
</template>
<script>
import RouteHead from './RouteHead.vue';
import SubmitButton from './SubmitButton.vue';
import TextIn from './TextIn.vue';
import axios from 'axios'

export default {
  name: "new-stadium",
  components: {
    RouteHead,
    SubmitButton,
    TextIn
    },
    props: {
        token: String
    },
    data() {
        return {
            filling_failure_indicator: false,
        };
    },
    methods: {
        onClickSubmit() {
            var rowsCount = this.$refs.rowsCount.content;
            var seatCount = this.$refs.seatCount.content;
            
            if(
                !(seatCount === '') &&
                !(rowsCount === '')              
            )
            {
                if(!rowsCount.match(/^\d+$/)){
                    alert('number of rows should be a number');
                }
                else if(!seatCount.match(/^\d+$/)){
                    alert('number of seats should be a number');
                }
                else{
                    // TODO: send create stadium request
                    const object = {
                        token: this.token,
                        rows_number: seatCount,
                        seats_number: rowsCount,
                    };
                    var self  = this
                    axios
                    .post('http://127.0.0.1:8000/api/CreateStadium', object)
                    .then(function (response){
                            self.$refs.rowsCount.content = ''
                            self.$refs.seatCount.content = ''
                            alert (response.data)
                        })
                    .catch(function (error) {
                            alert(error.response.data.error);
                        });
                }
            }

            else{
                this.filling_failure_indicator = true;
            }

        }
    }
};
</script>

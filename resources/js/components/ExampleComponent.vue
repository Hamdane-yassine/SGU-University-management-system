<template>
    <button @click="post()">Hello</button>
</template>

<script>
    export default {
        mounted() {
            // console.log('Component mounted.');
            // Echo.channel(`hello`)
            // .listen('Evt', (e) => {
            //     console.log(e.msg);
            // });
            // Pusher.logToConsole = true;

            // var pusher = new Pusher('175b6522f4a3c21fa191', {
            //     cluster: 'eu'
            // });

            // var channel = pusher.subscribe('hello');
            // channel.bind('pusher:subscription_succeeded', function(members) {
            //     // alert('successfully subscribed!');
            // });
            // channel.bind('.Evt', function(data) {
            //         console.log(data);
            // });

        },
        methods:{
            post(){
                axios.get('/h')
                        .then(response => {
                            console.log("res : "+response);
                        })
                        .catch(errors => {
                            console.log(errors);
                        });
            }
        }
    }
</script>

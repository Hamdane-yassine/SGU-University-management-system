/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    // created() {
    //     Pusher.logToConsole = true;

    //     var pusher = new Pusher('175b6522f4a3c21fa191', {
    //         cluster: 'eu'
    //     });

    //     var channel = pusher.subscribe('hello');
    //     channel.bind('pusher:subscription_succeeded', function(members) {
    //         console.log('successfully subscribed!');
    //     });
    //     channel.bind('\\App\\Events\\Evt', function(data) {
    //         console.log(data);
    //     });

    // }
});

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: false
// });


// var pusher = new window.Pusher('175b6522f4a3c21fa191', {
//     cluster: 'eu'
// });

// var channel = pusher.subscribe('hello');
// channel.bind('pusher:subscription_succeeded', function(members) {
//     // alert('successfully subscribed!');
// });
// channel.bind('\\App\\Events\\Evt', function(data) {
//     console.log(data);
// });

window.Echo.channel('hello')
    .listen('.Evt', (e) => {
        console.log(e);
    }).on('pusher:subscription_succeeded', (member) => {
        console.log('successfully subscribed!');
    });
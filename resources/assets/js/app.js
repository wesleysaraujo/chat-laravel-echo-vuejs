
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

const app = new Vue({
    el: '#app',
    data: {
        messages: [],
        usersInRoom: []
    },
    created() {
        axios.get('/messages').then((response) => {
            let messages = response.data;
            this.messages = messages;

            this.scrollBottom();
        });

        Echo.join('chatroom')
            .here((users) => {
                this.usersInRoom = users;
            })
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user);
            })
            .listen('MessagePosted', (e) => {
            this.messages.push({
                message: e.message.message,
                user: e.user
            });

            this.scrollBottom();
        });
    },
    methods: {
        addMessage(message) {
            if (message) {
                axios.post('/messages/add-message', message).then(response => {
                    this.messages.push(message);
                });
            }
        },

        scrollBottom() {
            $('.chat-log').animate({
                scrollTop: $('.chat-log').prop("scrollHeight")
            }, 400);
        }

    }
});

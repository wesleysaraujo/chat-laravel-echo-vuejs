<template>
    <div class="chat-composer">
        <input type="text" class="form-control" name="message" v-model="messageText" placeholder="Escreva sua mensagem aqui!" @keydown.enter="sendMessage">
        <button class="btn btn-primary" @click.prevent="sendMessage">Enviar</button>
    </div>
</template>
<script>
    export default {
        props: ['userName'],
        data () {
            return {
                messageText: "",
            }
        },
        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    message: this.messageText,
                    user: {
                        name: this.userName
                    },
                });

                this.messageText = '';
            }
        }
    }
</script>
<style lang="scss">
    .chat-composer {
        display: flex;
        margin-top: 10px;
        input{
            flex: 1 auto;
            border: none;
        }

        button{
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }
    }
</style>
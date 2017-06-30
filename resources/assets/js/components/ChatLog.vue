<template>
    <div class="chat-log" id="chat-log">
        <chat-message v-for="(m, index) in messages" :key="index" :message="m"></chat-message>
    </div>
</template>
<script>
    export default {
        props: ['messages'],
        mounted() {

        }

    }
</script>
<style lang="scss">
    .chat-log{
        max-height: 400px;
        overflow: auto;
        .chat-message {
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border-bottom: 1px solid #e8e8e8;
            &.chat-message:nth-child(even) {
                background-color: #f5f8fa;
            }
        }
    }
</style>
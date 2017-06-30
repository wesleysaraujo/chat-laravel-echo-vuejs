<template>
    <div class="chat-message" :id="message.id">
        <p>{{ message.message }}</p>
        <small>{{ message.user.name }}</small>
    </div>
</template>
<script>
    export default {
        props: ['message'],
        data() {
            return {
            }
        }
    }
</script>
<style lang="scss">

</style>
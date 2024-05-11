<template>
  <div>
    <h1>Frontend server</h1>
    <div v-for="message in messages" :class="['message', {system: message.system}]" :title="formatDate(message.time)">
      <div class="user">{{ message.user }}</div>
      <div class="text">{{ message.text }}</div>
    </div>
    <input v-model="text" type="text" @keydown.enter.prevent="send" />
  </div>
</template>

<script>
import io from 'socket.io-client'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
import localizedFormat from 'dayjs/plugin/localizedFormat'

require('dayjs/locale/pl')
dayjs.locale('pl')
dayjs.extend(relativeTime)
dayjs.extend(localizedFormat)

const createTimestamp = () => Math.floor((new Date()).getTime()/1000)

export default {
  name: 'IndexPage',
  data() {
    return {
      socket: null,
      text: '',
      messages: [],
    }
  },
  mounted() {
    this.socket = io('ws://localhost:3000');
    this.socket.on('chat.message.sent', obj => this.messages.push(obj))
  },
  methods: {
    send() {
      const message = {text: this.text, user: this.socket.id, time: createTimestamp()}
      // this.messages.push(message)
      this.$axios.post('http://localhost:3000/chat/message', message)
      // this.socket.emit('chat.message.send', message);
      this.text = ''
    },
    formatDate(date) {
      return dayjs.unix(date).format('HH:mm:ss YYYY-MM-DD')
    }
  }
}
</script>

<style lang="scss">
.message {
  display: flex;

  .user {
    color: #666;
    padding-right: 1rem;
  }

  .text {
    flex: 1;
  }

  &.system {
    .text {
      font-style: italic;
      color: #666;
    }
  }
}
</style>

const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server, {
    cors: {
        origin: "http://localhost:8080",
        methods: ["GET", "POST"]
    }
});
const amqplib = require('amqplib');
const cors = require('cors');

app.use(express.json())
app.use(cors({
    origin: "http://localhost:8080",
    methods: ["GET", "POST"]
}));

const createTimestamp = () => Math.floor((new Date()).getTime()/1000)

class Message {
    constructor(args) {
        this.text = null
        this.user = null
        this.time = createTimestamp()
        Object.assign(this, args)
    }
}

class SystemMessage extends Message {
    constructor(args) {
        super(args)
        this.system = true
    }
}

let channel, connection

async function connect() {
    try {
        // rabbitmq default port is 5672
        const amqpServer = 'amqp://admin:admin@rabbit:5672'
        connection = await amqplib.connect(amqpServer, {timeout: 5000})
        channel = await connection.createChannel()
        // make sure that the chat channel is created, if not this statement will create it
        await channel.assertQueue('chat')
        // ------------------------------------------------------------
        channel.consume('chat', (data) => {
            const content = Buffer.from(data.content)
            console.log(`Received from queue ${content}`)
            const event = JSON.parse(content)
            const message = new Message(event)
            console.log('Broadcasting', message)
            io.emit('chat.message.sent', message)
            channel.ack(data);
        })
    } catch (error) {
        console.error(error)
        process.exit(1)
    }
}
connect()

app.get('/', (req, res) => {
    res.send('<h1>Socket server</h1>');
});

app.post('/chat/message', (req, res) => {
    console.log('POST /send', req.body)
    channel.sendToQueue('chat', Buffer.from(JSON.stringify(req.body)), {timeout: 1000})
    res.send('OK')
});

io.on('connection', (socket) => {
    console.log('a user connected', socket.id);
    socket.broadcast.emit('chat.message.sent', new SystemMessage({text: 'User has connected', user: socket.id}))

    // socket.on('chat.message.send', event => {
    //     console.log('chat.message.send', event)
    //     socket.broadcast.emit('chat.message.sent', new Message(event))
    // })
});

app.get('*', (req, res) => {
    res.status(404).send('Not found')
})

server.listen(3000, () => {
    console.log('listening on *:3000');
});

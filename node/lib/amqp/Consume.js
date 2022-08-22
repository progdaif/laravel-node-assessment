
const Worker = require('./Worker');

let queueHandler = null;
let workerChannel = {};

class Consume extends Worker {

    constructor() {
        super();
        this._mode = 'consumeOnly'
    }

    _work(message, callback) {
        console.log("[AMQP] Message processing ", message);
        callback(true);
    }

    _processMessage(message) {
        new queueHandler(workerChannel, message);
    }

    _whenConnected() {
        this._fetchMessages();
    }

    _setChannel(channel) {
        workerChannel = channel;
    }

    fromQueue(queue, handler = null) {
        this._start();
        this._queue = queue;
        if (handler) {
            queueHandler = handler;
        }
    }
}


module.exports = new Consume();
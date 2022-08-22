const Publisher = require('./Publisher');

class Produce extends Publisher {

    #messages = [];

    constructor() {
        super();
        this._mode = 'produceOnly';
    }

    _invokePublish() {
        for (const message of this.#messages) {
            let exchange = "";
            if (message.hasOwnProperty('exchange')) {
                exchange = message['exchange'];
            }
            let queue = "";
            if (message.hasOwnProperty('queue')) {
                queue = message['queue'];
            }
            let messageContent = "";
            if (message.hasOwnProperty('message')) {
                messageContent = message['message'];
            }
            this._publish(exchange, queue, Buffer.from(messageContent));
        }
    }

    _whenConnected() {
        this._createChannel();
    }

    messages(dataToBePublished = []) {
        this._start();
        this.#messages = dataToBePublished;
    }
}

module.exports = new Produce();
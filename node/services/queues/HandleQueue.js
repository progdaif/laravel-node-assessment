class HandleQueue {

    #channel = {};
    #message = "";

    /** initial channel and message to be processed */
    constructor(channel, message) {
        this.#channel = channel;
        this.#message = message;
        this._work();
    }

    /** worker to pass messages to handler */
    _work() {
        try {
            const processedMessage = this.#message.content.toString('utf-8');

            // called from concrete class
            this._handle(processedMessage);
            this.#channel.ack(this.#message);
            console.log("[AMQP] Message processing ", processedMessage);
        } catch (e) {
            this.#channel.reject(this.#message, true);
            console.log("[AMQP] Message processing failed", e.message);
        }
    }
}

module.exports = HandleQueue;
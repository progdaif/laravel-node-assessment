const AMQPConnection = require("./AMQPConnection");

class Worker extends AMQPConnection {

    constructor() {
        super();
    }

    _fetchMessages() {
        const self = this;
        this._connection.createChannel(function (error, channel) {
            if (error) {
                throw error;
            }
            channel.on("error", function (error) {
                console.error("[AMQP] Channel error", error);
            });
            channel.on("close", function () {
                console.log("[AMQP] Channel closed");
            });
            //channel.prefetch(10);
            channel.assertQueue(self._queue, { durable: true }, function (error, _ok) {
                if (error) {
                    console.log("[AMQP] Error while assertQueue", error.message);
                    return;
                }
                channel.consume(self._queue, self._processMessage, { noAck: false });
                console.log("[AMQP] Worker consumed");
            });
            self._currentChannel = channel;
            self._setChannel(channel);
        });
    }
}

module.exports = Worker;
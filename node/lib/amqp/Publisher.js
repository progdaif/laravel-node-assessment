const AMQPConnection = require("./AMQPConnection");

class Publisher extends AMQPConnection {

    /** for failed messages */
    #offlinePubQueue = [];
    _offlineMessages = false;

    constructor() {
        super();
    }

    _publish(exchange, routingKey, content) {
        try {
            const self = this;
            this._currentChannel.publish(exchange, routingKey, content, { persistent: true },
                function (error, ok) {
                    if (error && self._offlineMessages) {
                        self.#offlinePubQueue.push([exchange, routingKey, content]);
                    }
                    if (error) {
                        console.error("[AMQP] Publish failed", error.message);
                        self._currentChannel.connection.close();
                    }
                });
        } catch (e) {
            console.error("[AMQP] Publish error ", e.message);
            if (this._offlineMessages) {
                this.#offlinePubQueue.push([exchange, routingKey, content]);
            }
        }
    }

    _createChannel() {
        const self = this;
        this._connection.createConfirmChannel(async function (error, channel) {
            if (error) {
                console.error("[AMQP] Server error", error.message);
                self._connction.close();
                throw error;
            }

            channel.on("error", function (error) {
                console.error("[AMQP] Channel error", error.message);
            });

            channel.on("close", function () {
                console.log("[AMQP] Channel closed");
            });

            self._currentChannel = channel;
            self._invokePublish();

            if (self._offlineMessages) {
                setInterval(
                    () => {
                        if (self.#offlinePubQueue.length === 0) {
                            return;
                        }
                        // re-sending failed messages
                        const [exchange, routingKey, content] = self.#offlinePubQueue.shift();
                        self._publish(exchange, routingKey, content);
                    }, 1
                );
            }
        });
    }
}

module.exports = Publisher;
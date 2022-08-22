
const amqp = require('amqplib/callback_api');

class AMQPConnection {

    _connection = {};
    _mode = "";
    _queue = {};
    _currentChannel = {};

    constructor() {

    }

    _start() {
        const self = this;
        amqp.connect(process.env.CLOUDAMQP_URL, function (error, connection) {
            if (error) {
                console.error("[AMQP] Server error", error.message);
                connection.close();
                throw error;
            }
            connection.on("error", function (error) {
                if (error.message !== "Connection failed") {
                    console.error("[AMQP] Connection error", error.message);
                }
            });
            if (self._mode == 'produceOnly') {
                setTimeout(function () {
                    connection.close();
                    console.log("[AMQP] Disconnected");
                    process.exit(0)
                }, 100);
            } else {
                /** reconnecting */
                connection.on("close", function () {
                    console.error("[AMQP] Connection closed. will reconnect in a second");
                    return setTimeout(() => { this.start }, 1000);
                });
            }
            console.log("[AMQP] Connected");
            self._connection = connection;
            self._whenConnected();
        });
    }
}

module.exports = AMQPConnection;
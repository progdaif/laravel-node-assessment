const HandleQueue = require('./HandleQueue');
const PaidReservationEmailService = require('../PaidReservationEmailService')

class HandleQueueEmails extends HandleQueue {

    constructor(channel, message) {
        super(channel, message);
    }

    // get the message to prepare it for emailing
    _handle(message) {
        try {
            // call email sender 
            let emailService = new PaidReservationEmailService(message);
            emailService.send();
        } catch (e) {
            console.log("[AMQP] Message handling failed", e.message);
        }
    }
}

module.exports = HandleQueueEmails;
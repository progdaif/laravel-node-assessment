class PaidReservationEmailService {

    #reservation = {};

    /** initial channel and message to be processed */
    constructor(reservation) {
        this.#reservation = reservation;
    }

    /** Send email */
    send() {
        try {
            /**
             * this.#reservation should be prepared and decoded
             * to get email to send to it from reservation
             */

            //Send Email code goes here
            console.log("Send Email code goes here");


            console.log("[MAIL] Mail sent successfull");
        } catch (e) {
            console.log("[MAIL] Mail sending failed", e.message);
        }
    }
}

module.exports = PaidReservationEmailService;
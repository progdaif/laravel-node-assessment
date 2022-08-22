/**
 * App dispatcher
 */

// Load .env data
require('dotenv').config();

const Consume = require('./lib/amqp/Consume');
const HandleQueueEmails = require('./services/queues/HandleQueueEmails');

// Consume emails messages from queue 'emails'
Consume.fromQueue('emails', HandleQueueEmails);

/**
 * App dispatcher
 */

require('dotenv').config();

//const redis = require('./redis');
//redis.run();

const mq = require('./mq');
mq.run();

//const db = require('./mongodb');
//db.run();
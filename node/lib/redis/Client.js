const Redis = require('ioredis');

class Client {

    _client = {};
    _key = "";
    _value = "";
    _getCallback = () => { };

    constructor() {

    }

    async _connect() {
        try {
            this._client = new Redis({
                port: process.env.REDIS_PORT, // Redis port
                host: process.env.REDIS_HOST, // Redis host
                db: 0, // Defaults to 0
            });
            console.log('[Redis] Connected');
        } catch (error) {
            console.error('[Redis] Connection failed', error.message);
        }
    }

    _dataAccessed(error, value) {
        if (error) {
            console.error('[Redis] Access data failed', error.message);
        }
        this._getCallback(value);
    }

    async set(keyToBeSet, valueToBeSet) {
        await this._connect();
        this._key = keyToBeSet;
        this._value = valueToBeSet;
        this._setData();
    }

    async get(keyToBeSet, getCallback = null) {
        await this._connect();
        this._key = keyToBeSet;
        if (getCallback) {
            this._getCallback = getCallback;
        }
        this._getData();
    }
}

module.exports = Client;
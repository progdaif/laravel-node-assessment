const Client = require('./Client');

class Key extends Client {

    constructor() {
        super();
    }

    _setData() {
        this._client.set(this._key, this._value);
    }

    _getData() {
        const self = this;
        this._client.get(this._key, (error, value) => {
            self._dataAccessed(error, value);
        });
    }
}

module.exports = new Key();
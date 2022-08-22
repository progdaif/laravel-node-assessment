const Client = require('./Client');

class HashMap extends Client {
    _setData() {
        this._client.hmset(this._key, this._value);
    }

    _getData() {
        const self = this;
        this._client.hgetall(this._key, (error, value) => {
            self._dataAccessed(error, value);
        });
    }
}

module.exports = new HashMap();
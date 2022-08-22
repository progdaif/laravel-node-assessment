const Client = require('./Client');

class List extends Client {
    _setData() {
        this._client.rpush([this._key, ...this._value]);
    }

    _getData() {
        const self = this;
        this._client.lrange(this._key, 0, -1, (error, value) => {
            self._dataAccessed(error, value);
        });
    }
}

module.exports = new List();
const Client = require('./Client');

class DataSet extends Client {
    _setData() {
        this._client.sadd([this._key, ...this._value]);
    }

    _getData() {
        const self = this;
        this._client.smembers(this._key, (error, value) => {
            self._dataAccessed(error, value);
        });
    }
}

module.exports = new DataSet();
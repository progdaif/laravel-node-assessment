const mongoose = require('mongoose');

class Client {

    _client = {};
    _collection = {};
    _callback = () => { };

    constructor() {

    }

    _loadModel(collection) {
        const modelsPath = '../../models'
        return require(`${modelsPath}/${collection}`).model;
    }

    async _selectCollection(collection) {
        this._collection = this._loadModel(collection);
        this._collection = await new this._client.model(collection, this._collection);
    }

    async _connect(collection) {
        try {
            const env = process.env;
            let connectionString = `mongodb://${env.MONGODB_HOST}:`;
            connectionString += `${env.MONGODB_PORT}/${env.MONGODB_DBNAME}`;
            await mongoose.connect(connectionString);
            this._client = mongoose;
            this._selectCollection(collection);
        } catch (error) {
            console.error('[MongoDB] Connection failed', error.message);
        }
    }
}

module.exports = Client;
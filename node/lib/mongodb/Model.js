const Client = require('./Client');

class Model extends Client {

    _client = {};
    _callback = () => { };

    constructor() {
        super();
    }

    async findOne(collection, where = {}) {
        try {
            await this._connect(collection);
            return this._collection.findOne(where);
        } catch (error) {
            console.error('[MongoDB] Selection failed', error.message);
        }
    }

    async findAll(collection, where = {}) {
        try {
            await this._connect(collection);
            return this._collection.find(where);
        } catch (error) {
            console.error('[MongoDB] Selection failed', error.message);
        }
    }

    async insert(collection, data) {
        try {
            await this._connect(collection);
            const document = new this._collection(data);
            return document.save();
        } catch (error) {
            console.error('[MongoDB] Insertion failed', error.message);
        }
    }

    async updateOne(collection, where, data) {
        try {
            await this._connect(collection);
            return this._collection.updateOne(where, { $set: data });
        } catch (error) {
            console.error('[MongoDB] Selection failed', error.message);
        }
    }

    async updateAll(collection, where, data) {
        try {
            await this._connect(collection);
            return this._collection.update(where, { $set: data });
        } catch (error) {
            console.error('[MongoDB] Selection failed', error.message);
        }
    }

    async deleteOne(collection, where) {
        try {
            await this._connect(collection);
            return this._collection.deleteOne(where);
        } catch (error) {
            console.error('[MongoDB] Selection failed', error.message);
        }
    }

    async deleteAll(collection, where) {
        try {
            await this._connect(collection);
            return this._collection.deleteMany(where);
        } catch (error) {
            console.error('[MongoDB] Selection failed', error.message);
        }
    }

}

module.exports = new Model();
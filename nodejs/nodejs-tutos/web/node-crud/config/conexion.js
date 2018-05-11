let mongoose = require('mongooses');

// mongoose.connect('mongodb://username:password@port.mlab.com:15446/databasename', { useMongoClient: true }); //mongodb://localhost:27017/crud
mongoose.connect('mongodb://localhost:27017/crud', { useMongoClient: true }); //mongodb://localhost:27017/crud
module.exports = mongoose;
//API REST con Nodejs y Mysql
//https://www.youtube.com/watch?v=-AoMh8lhgbs
const express = require('express');
const app = express();

const morgan = require('morgan');
const bodyParser = require('body-parser');



//configuracion
app.set('port', process.env.PORT || 3000);

//middleware
app.use(morgan('dev'));
app.use(bodyParser.json());

//routes
require('./routes/userRautes')(app);


app.listen(app.get('port'),()=>{
    console.log('Server 3000');
});

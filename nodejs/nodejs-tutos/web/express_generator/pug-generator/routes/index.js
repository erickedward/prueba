var express = require('express');
var router = express.Router();

let personas = [
  { id:1,nombre:"Erick" },
  { id:2,nombre:"Nailet" },
  { id:3,nombre:"Ronald" },
  { id:4,nombre:"Naiyerith" }
]

router.get('/',(req,res) =>{
  res.render('index',{titulo:'pug', mensaje:'Hola Erick | pug', personas: personas})
});

/* GET home page. */
// router.get('/', function(req, res, next) {
//   res.render('index', { title: 'Express' });
// });

module.exports = router;

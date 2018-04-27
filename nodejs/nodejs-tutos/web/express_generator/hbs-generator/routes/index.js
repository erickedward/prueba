var express = require('express');
var router = express.Router();

/* GET home page. */
// router.get('/', function(req, res, next) {
//   res.render('index', { title: 'Express' });
// });

let personas = [
  { id:1,nombre:"Erick" },
  { id:2,nombre:"Nailet" },
  { id:3,nombre:"Ronald" },
  { id:4,nombre:"Naiyerith" }
]

router.get('/',(req,res) =>{
  res.render('index',{titulo:'hbs', mensaje:'Hola Erick | hbs', personas: personas})
});

module.exports = router;

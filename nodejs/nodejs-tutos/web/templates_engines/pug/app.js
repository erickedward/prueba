const express = require('express');
const app = express();

let personas = [
    { id:1,nombre:"Erick" },
    { id:2,nombre:"Nailet" },
    { id:3,nombre:"Ronald" },
    { id:4,nombre:"Naiyerith" }
]

app.set('view engine','pug');


app.get('/',(req,res) =>{
    res.render('template',{titulo:'pug', mensaje:'Hola Erick | pug', personas: personas})
});

app.listen(3000,() => {
    console.log('Ejemplo escuchado por el puerto 3000');
}); 
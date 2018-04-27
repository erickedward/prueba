const express = require('express');
const app = express();

let  islogin = () => true;

let logger = (req,res,next) => {
    console.log("Peticion de tipo: ",req.method);
    next();
}

let showIP = (req,res,next) => {
    console.log("IP: 127.0.0.1");
    next();
}

app.use((request,response,next) => {
    if (islogin()){
        next();
    }else{
        response.send('Usuario no logueado');
    }
},logger,showIP);

//app.use(logger);
app.get('/',(req,res) => {
    res.send(`Hola mundo ${req.method}`);
});

app.get('/:usuario',(req,res) => {
    let texto = `Hola mundo ${req.method}`;
    texto += `<br><br>Bienvenido ${req.params.usuario}`;
    res.send(texto);
});

app.post('/',(req,res) => {
    res.send(`Hola mundo ${req.method}`);
});
app.put('/',(req,res) => {
    res.send(`Hola mundo ${req.method}`);
});
app.delete('/',(req,res) => {
    res.send(`Hola mundo ${req.method}`);
});
app.listen(3000,() => {
    console.log('Ejemplo escuchado por el puerto 3000');
});
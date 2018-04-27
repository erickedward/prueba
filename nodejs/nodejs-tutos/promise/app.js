let promesa2 = require("./promesa");

let promesa = new Promise((resolve,reject)=>{
    let modo=2;
    if (modo===1) resolve('Exito al procesar la funcion');
    else reject('error al procesar la funcion');
});

promesa.then((resultado)=>{
    console.log(resultado);
}, (error) => {
    console.log(error);
});

// parte 2 del ejercicio

promesa2.calcular(5,3).then((resultado)=>{
    console.log(resultado);
}, (error) => {
    console.log(error); 
});

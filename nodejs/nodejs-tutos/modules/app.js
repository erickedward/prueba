const os = require('os');
const fs = require('fs');

const mi = require('./mito');

mi.saludar();
console.log(mi.subs);

console.log("Suma: " + mi.sumar(10,5));
console.log("Resta: " + mi.resta(10,5));
console.log("Mostrar: " + mi.mostrar(5));


let cpu = os.cpus();
let sistema = os.platform();
let usuario = os.hostname();

let cpu_string =  JSON.stringify(cpu);
// fs.appendFile('mitocode.txt','Información del cpu: '+cpu_string,function(error){
//     if (error)
//         console.log('Error al crear el archivo');
// });

setTimeout(() => {
    console.log('\n\n*******\nTermine\n*******')
},2000);
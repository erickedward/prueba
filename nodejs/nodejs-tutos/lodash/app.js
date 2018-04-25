const _ = require('lodash');
let programas = 7;

let x = {"nombre":"Erick"}
let y = {"apellido":"Ramirez"}
let z = [{nombre:"Nailet",apellido:"Colina",edad:34},
{nombre:"Ronald",apellido:"Ramirez",edad:5},
{nombre:"Naiyerith",apellido:"Ramirez",edad:0}];

let resultado = "";
switch(programas){
    case 1:
        // resultado = _.assign(x,y);
        // console.log(resultado);
    break;
    case 2:
        _.times(3, ()=>console.log("For a 3 veces"));
    break;
    case 3://Buscador de datos en array
        resultado = _.find(z,{apellido:"Ramirez"});
        console.log(resultado);
    break;
    case 4://Buscador de datos en array con mas de un atributo
        resultado = _.find(z,{nombre:"Ronald",apellido:"Ramirez"});
        console.log(resultado);
    break;
    case 5://capturar valores del usuario
        console.log(process.argv);
        // Forma de probar en consola
        //     node app.js
        //     node app.js dato1
        //     node app.js dato1 dato2
    break;
    case 6:
        // Forma de probar en consola
        //      node app.js usuario apellido
        let comando = process.argv[2];
        if (process.argv[2]==="usuario" && process.argv[3]==="apellido"){
            console.log("Usuario Valido");
        }else{
            console.log("Usuario Invalido");
        }//end if
    break;
    case 7: //Uso de la dependencia yargs
        const argv = require("yargs").argv;
        //console.log(argv);
        if (argv.usuario === "ramirez"){
            console.log("Usuario Valido");
        }else{
            console.log("Usuario Invalido");
        }//end if
    break;
}
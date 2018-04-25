// Probar como debuguear una aplicacion
// en consola
//     node inspect app.js
//     precionar "n" para ir linea por linea y "c" para ir hasta el proximo 
//     punto de debugger o en su defecto hasta el final
// ******************************************************************************************
// instalamos nodemon que es un inspector automatico con NPM
// lo instalamos de forma global para que funcione para todas las aplicaciones de node
//     npm i -g nodemon
// para correrlo en consola 
//      nodemon app.js
//      nodemon app.js inspect
// ******************************************************************************************
// Escribimo en un explorador de chrome lo siguiente
//     chrome://inspect
// luego en consola lo siguiente
//     node --inspect-brk app.js -> este lo realiza paso a paso
//     nodemon --inspect-brk app.js -> queda como impector continuo
// debe aparecer en la seccion target el archivo a debuguear

const extra = require('./extra');
extra.saludar();

let curso = "nodeeeee";
curso = "node.js";
curso = "node.js tutos";
debugger;
console.log(curso);
x = ()=>{
    debugger;
    return 1+10;
}
debugger;
console.log(x());
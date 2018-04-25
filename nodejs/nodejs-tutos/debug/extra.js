let mensaje = "Debugueando el codigo!";
 
function saludar(){
    debugger;
    console.log(mensaje);
}

module.exports = {
    saludar: saludar
}
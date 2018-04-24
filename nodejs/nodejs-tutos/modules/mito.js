// module.exports.saludar = function saludar(){
//     console.log('Hola Erick ...')
// }
module.exports = {
    subs : 20000,
    saludar : function saludar(){
        console.log('Hola Erick ...')
    },
    sumar : (a,b) => {
        return a+b;
    },
    resta : (a,b) => a-b,
    mostrar : a => a + 10
}
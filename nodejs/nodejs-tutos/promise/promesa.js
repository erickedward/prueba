let calcular = (numero1,numero2) => {
    return new Promise((ejecuta,error) => {
        setTimeout(()=>{
            console.log("\n****************Parte 2 ******************");
            let suma = numero1+numero2;
            if (suma>5){
                ejecuta("Suma: "+(numero1+numero2));
            }else{
                error('Error al procesar la suma por resultado ser menor o igual a 5');
            }
        },2000);
    });
};

module.exports = {
    calcular
}
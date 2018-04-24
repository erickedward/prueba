const fs = require('fs');
//sincrono y asincrono
let sincrono = false; // Cambiar para colocar sincrono y asincrono
console.log('Iniciado');
if (!sincrono){
    
    fs.readFile('data.txt', 'utf-8', (error,data) => {
        if(error){
            console.log('Error' + error);
        }else{
            console.log(data);
        }
    });

}else{
    let data = fs.readFileSync('data.txt','utf-8');
    console.log(data);
}
console.log('Finalizado');

//Renombra archivo
fs.rename('data.txt','data_renombrado.txt',(error) =>{
    if(error) throw error;
    console.log('Renombrado');
});

//Agrega datos en archivo
fs.appendFile('data.txt','\nGracias se realizo el agregado', (error)=>{
    if (error) console.log('Error' + error);
})

//Elimina archivo
fs.unlink('data2.txt', (error)=>{
    if (error) throw error;
    console.log('Eliminado');
});

fs.createReadStream('data.txt').pipe(fs.createWriteStream('data3.txt'));

// fs.readdir('./../../basico/',(error,files)=>{
//     files.forEach(file => {
//         console.log(file);
//     },);
// });
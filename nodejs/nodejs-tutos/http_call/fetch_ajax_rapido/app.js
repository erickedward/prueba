const fetch = require("node-fetch");

let promesa = fetch('https://api.github.com/users/mitocode21');

promesa.then((res)=>{
    return res.json();
},(error) => {
    console.log("hubo un error: "+error);
}).then((json)=>{
    console.log(json);
});
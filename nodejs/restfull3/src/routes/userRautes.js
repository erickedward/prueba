const User = require('../models/user');

module.exports = function(app) {
    app.get('/users',(req,res) => {
        User.getUsers((err,data) =>{
           res.status(200).json(data);
        })
    });

    app.post('/users',(req,res)=>{
        //console.log(req.body);
        const userData = {
            id:null,
            nombre: req.body.nombre,
            ciudad: req.body.ciudad
        };

        User.insertUniv(userData, (err, data) => {
            console.log(data);
            if (data && data.insertId){
                res.json({
                    success:true,
                    msg:"Insert Satisfactorio",
                    data:data
                })
            }else{
                res.status(500).json({
                    success:false,
                    msg:"error"
                })
            }
        });

    });
}
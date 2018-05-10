const mysql = require('mysql');

connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'naiyerith',
    database: 'universidades'
});

let userModel = {};

userModel.getUsers = (callback) => {
    if (connection) {
        connection.query(
            'SELECT * FROM universidades ORDER BY id',
            (err,rows) => {
                if(err){
                    throw err;
                }else{
                    callback(null,rows);
                }
            }
        );
    }
};

userModel.insertUniv = (userData,callback) => {
    if (connection) {
        connection.query(
            'INSERT INTO universidades SET ?',
            userData,
            (err,result) => {
                if (err) {
                    throw err;
                }else{
                    callback(null,{
                        'insertId': result.insertId
                    })
                }
            }
        )
    }
}

module.exports = userModel;
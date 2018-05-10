var mysql = require('mysql');
 
var client = mysql.createConnection({
  user: 'root',
  password: 'naiyerith',
  host: '127.0.0.1',
  port: '3306',
});
 
client.query('USE universidades');

client.query(
    'INSERT INTO universidades SET nombre = ?, ciudad = ?',
    ['erick', 'caracas']
  );
   
  client.query(
      'SELECT * FROM universidades',
      function selectUsuario(err, results, fields) {
   
      if (err) {
          console.log("Error: " + err.message);
          throw err;
      }
   
      console.log("Number of rows: "+results.length);
      console.log(results);
   
      client.end();
  });
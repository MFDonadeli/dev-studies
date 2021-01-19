const http = require('http');

const hostname = 'app';
const port = 3000;
const config = {
    host: 'db',
    user: 'root',
    password: 'root',
    database: 'nodedb'
};
const mysql = require('mysql')
const connection = mysql.createConnection(config)

const create_db = "CREATE TABLE IF NOT EXISTS people (id int not null auto_increment, name varchar(255), primary key(id))"
connection.query(create_db)

const sql = `INSERT INTO people(name) VALUES ('Teste')`
connection.query(sql)
connection.end()

app.get('/', (req,res) => {
  res.send('<h1>Full Cycle</h1>')
})

app.listen(port, ()=> {
  console.log('Rodando na porta ' + port)
})
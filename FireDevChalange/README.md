## Configurações do banco
* Criei uma tabela chamada `challenge` no phpmyAdmin Local, mas esse nome e senha do banco podem ser
pode ser alterado e apontados no arquivo `dbConfig`;
* Script da tabela `users`:
```sql
CREATE TABLE IF NOT EXISTS users (
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  senha varchar(255) NOT NULL
);

INSERT INTO users (name, email, senha) VALUES ('Xavier', 'xavier@gmail.com', '12345678');
```

## END POINTS
* localhost/FireDevChalange/api/auth/
  * Descrição: Cria Bearer Token de acordo com login de email e senha;
  * Method POST;
  * Request esperada:
  ```json
  {
    "name": "Nome do usuario",
    "email": "Email do usuario"
  }
  ```
  * Exemplo de retorno:
  ```json
  {
    "status": "sucess",
    "data": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InhhdmllckBnbWFpbC5jb20ifQ.q8FttaxLxd3FGwXI0pHb44lcTEkCGm92XAD2e06I2X0"
  }
  ```

* localhost/FireDevChalange/api/users/
  * Descriçao: Retorna uma lista de todos os usuários.
  * Method GET;
  * Exemplo de retorno
  ```json
  {
    "status": "sucess",
    "data": [
      {
        "id": "1",
        "name": "Xavier",
        "email": "xavier@gmail.com",
        "senha": "12321333"
      },
      {
        "id": "2",
        "name": "Victor",
        "email": "xavier@gmail.com",
        "senha": "12312"
      }
    ]
  }
  ```
* localhost/FireDevChalange/api/users/{ userID }
  * Descrição: Busca um usuário expecifico por ID. 
  * Method GET;
  * Exemplo de retorno
  ```json
  {
    "status": "sucess",
    "data": [
      {
        "id": "1",
        "name": "Xavier",
        "email": "xavier@gmail.com",
        "senha": "12321333"
      }
    ]
  }
  ```
* localhost/FireDevChalange/api/users/
  * Descrição: Cria um novo usuário.
  * Method POST;
  * Request esperada:
  ```json
  {
    "name": "Nome do usuario",
    "email": "Email do usuario",
    "senha": "Senha do usuario"
  }
  ```
  * Exemplo de retorno
  ```json
  {
    "status": "sucess",
    "data": "Usuário inserido com sucesso!"
  }
  ```
  
* localhost/FireDevChalange/api/users/{ userId }
  * Descrição: Atualiza nome e email de um usuário expecifico por Id.
  * Method PUT;
  * Requast esperada:
  ```json
  {
    "name": "Nome do usuario",
    "email": "Email do usuario"
  }
  ```
  * Exemplo de retorno
  ```json
  {
    "status": "sucess",
    "data": "Usuário editado com sucesso!"
  }
  ```

* localhost/FireDevChalange/api/users/{ userId }
  * Descrição: Deleta um usuario expecifico por Id.
  * Method DELETED;
  * Exemplo de retorno
  ```json
  {
    "status": "sucess",
    "data": "Usuário deletado com sucesso!"
  }
  ```
Controle de Atividades API - v1.0
=======================

Introdução
------------
Projeto provê uma API para sistema de gerenciamento de atividades. O projeto foi desenvolvido com o Zend Framework 2 e Doctrine 2.


#### Requisitos
------------
* PHP 5.3+
* [Doctrine 2](http://www.doctrine-project.org)
* [Zend Framework 2](https://github.com/zendframework/zf2)


Instalação
------------

##### Dependências
------------
Após realizar o clone, é necessário baixar as dependências do projeto por meio do **composer**, basta realizar os comandos no terminal: "php composer.phar self-update" e "php composer.phar install"

**OBS**: Caso utilize o sistema operacional Windows é recomendável a utilização do [git
bash](https://git-scm.com/downloads).

##### Banco de dados
------------
Dentro da pasta **sql** na raiz do projeto, existe o arquivo **exe_sql.bat**, basta executá-lo e automáticamente o banco de dados será criado. OBS: Utilizado para testes o usuário DEFAUT do MySql, user = root, pass = '', caso seja necessário a utilização de senha, altere o arquivo **exe_sql.bat** para: ***mysql -u SEU_USUARIO  -p SUA_SENHA --default-character-set=utf8 < _criabanco.sql***

A configuração do Doctrine está no arquivo **config/autoload/doctrine.local.php**, caso seja necessário a alteração da senha do banco de dados.


Resposta das atividades
====================

### Questão 1:
```php
for($i=1;$i<=100;$i++) {

    $print = null;
    if(! ($i%3)) {
        $print .= 'Fizz';
    }

    if(! ($i%5)) {
        $print .= 'Buzz';
    }

    if(is_null($print)) {
        $print .= $i;
    }
    echo $print . '<br />';
}
```

### Questão 2:
```php
const URL = 'http://www.google.com';
const PATH_LOGGED = 'loggedin';
if((isset($_SESSION[PATH_LOGGED]) && $_SESSION[PATH_LOGGED]) || 
   (isset($_COOKIE[PATH_LOGGED])  && $_COOKIE[PATH_LOGGED])) {
   
    header(sprintf("Location:%s", URL));
    exit();
}
```

### Questão 3:
```php
use DatabaseConnectionInterface;

class MyUserClass
{
    /**
     * @var DatabaseConnectionInterface;
     */
    protected $dbconn;

    /**
     * @param DatabaseConnectionInterface $databaseConnection
     */
    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->dbconn = $databaseConnection;
    }

    /**
     * @return Collection
     */
    public function getUserList()
    {
        return $this->dbconn->query('select name from user order by id asc');
    }
}
```

Controle de Atividades API - v1.0
=======================

Introdução
------------
Projeto provê uma API para um sistema de gerenciamento de atividades.


#### Requirements
------------
* PHP 5.3+
* [Doctrine 2](http://www.doctrine-project.org)
* [Zend Framework 2](https://github.com/zendframework/zf2)


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

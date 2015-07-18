# controle-atividade
API REST para um sistema gerenciador de atividades.

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
use DatabaseConnection;

class MyUserClass
{
    /**
     * @var DatabaseConnection;
     */
    protected $dbconn;

    /**
     * @param DatabaseConnection $databaseConnection
     */
    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->dbconn = $databaseConnection;
    }

    /**
     * @return Collection
     */
    public function getUserList()
    {
        return $this->dbconn->query('select name from user order by name asc');
    }
}
```

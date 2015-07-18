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
Após realizar o clone, é necessário baixar as dependências do projeto por meio do **composer**, siga até a pasta raiz do projeto e realize os seguintes comandos no terminal: 
```console
cd /caminho/ate/servidor/controle-atividade
php composer.phar self-update
php composer.phar install
```

**OBS**: Caso utilize o sistema operacional Windows é recomendável a utilização do [git
bash](https://git-scm.com/downloads).

##### Banco de dados
------------
Dentro da pasta **sql** na raiz do projeto, existe o arquivo **exe_sql.bat**, basta executá-lo e automáticamente o banco de dados será criado. OBS: Utilizado para testes o usuário DEFAUT do MySql, user = root, pass = '', caso seja necessário a utilização de senha, altere o arquivo **exe_sql.bat** para: ***mysql -u SEU_USUARIO  -p SUA_SENHA --default-character-set=utf8 < _criabanco.sql***

A configuração do Doctrine está no arquivo **config/autoload/doctrine.local.php**, caso seja necessário a alteração da senha do banco de dados.

##### Servidor
------------
Para a utilização do Zend Framework com o php-5.3 é necessário algumas configurações no servidor, caso seja utilizado o **[nginx](http://nginx.org/en/download.html)** como servidor de aplicação. Os testes foram realizados com a seguinte configuração para o Apache:
```console
server {
    listen       80;
    server_name  controleatividade.com;

    access_log off;
    error_log /caminho/ate/log/nginx/controleatividade.error.log;

    root /caminho/ate/servidor/controle-atividade/public;

    index index.html index.htm index.php;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~* \.(?:ico|css|js|gif|jpe?g|png)$ {
        expires max;
        add_header Pragma public;
        add_header Cache-Control "public, must-revalidate, proxy-revalidate";
    }

    location ~ \.(php|phtml)$ {
         fastcgi_pass 127.0.0.1:9000;
         fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
         include fastcgi_params;
    }
    
    location ~ /\. {
         deny all;
    }
}
```
Exemplo, caso o servidor de aplicação seja o **[apache]**(http://httpd.apache.org/download.cgi):
```console
<VirtualHost *:80>
     ServerName controleatividade.com;
     DocumentRoot /caminho/ate/servidor/controle-atividade/public;
     <Directory /caminho/ate/servidor/controle-atividade/public>
         DirectoryIndex index.php
         AllowOverride All
         Order allow,deny
         Allow from all
     </Directory>
 </VirtualHost>
```
Documentação do [ZF 2 - config](http://framework.zend.com/manual/current/en/user-guide/skeleton-application.html)



Projeto
------------
O projeto foi desenvolvido em 3 módulos:
* **Base**: Contém todas as Abstrações, Interfaces, Exceptions, ViewHelpers do sistema, ou seja, é o módulo integrador dos outros módulos.
* **App**: É a aplicação em si, todas as rotas, controllers e views referentes ao gerenciamento dos controles de atividades estão neste módulo.
* **Api**: Este módulo é responsável por disponibilizar a API para o CRUD relacionado às atividades. É neste módulo que está contido o Controller: **module/Api/src/Api/Controller/AtividadeApiRestController**, responsável por disponibilizar os métodos HTTP (GET, PUT, POST, DELETE) para realização de consultas e alterações nos cadastros.


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

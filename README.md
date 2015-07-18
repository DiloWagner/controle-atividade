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
Todas as dependências do projeto estão na pasta **vendor/**, (Frameworks e bibliotecas utilizadas).

##### Banco de dados
------------
Dentro da pasta **sql** na raiz do projeto, existe o arquivo **exe_sql.bat**, basta executá-lo e automáticamente o banco de dados será criado. OBS: Utilizado para testes o usuário DEFAUT do MySql, user = root, pass = '', caso seja necessário a utilização de senha, altere o arquivo **exe_sql.bat** para: ***mysql -u SEU_USUARIO  -p SUA_SENHA --default-character-set=utf8 < _criabanco.sql***

Em sistemas UNIX, é possível realizar a criação através do comando:
```console
bash exe_sql.bat
```
**OBS**: Caso utilize o sistema operacional Windows é recomendável a utilização do [git
bash](https://git-scm.com/downloads).


A configuração do Doctrine está no arquivo **config/autoload/doctrine.local.php**, caso seja necessário a alteração da senha do banco de dados.

##### Servidor
------------
Para a utilização do Zend Framework com o php-5.3 é necessário algumas configurações no servidor, caso seja utilizado o **[nginx](http://nginx.org/en/download.html)**:

```console
server {
    listen       80;
    server_name  meu-servidor.com;

    access_log off;
    error_log /caminho/ate/log/nginx/meu-servidor.error.log;

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
Exemplo, caso o servidor de aplicação seja o **[apache](http://httpd.apache.org/download.cgi)**:
```console
<VirtualHost *:80>
     ServerName meu-servidor.com;
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

Após a configuração do servidor basta acessar a URL: **http://meu-servidor/atividade**


Projeto
------------
O projeto foi desenvolvido em 3 módulos:
* **Base**: Contém todas as Abstrações, Interfaces, Exceptions, ViewHelpers do sistema, ou seja, é o módulo integrador dos outros módulos.
* **App**: É a aplicação em si, todas as rotas, controllers e views referentes ao gerenciamento dos controles de atividades estão neste módulo.
* **Api**: Este módulo é responsável por disponibilizar a API para o CRUD relacionado às atividades. É neste módulo que está contido o Controller: **module/Api/src/Api/Controller/AtividadeApiRestController**, responsável por disponibilizar os métodos HTTP (GET, PUT, POST, DELETE) para realização de consultas e alterações nos cadastros.

O módulo **App** contém um CRUD básico para realizar as operações de criar, alterar e excluir as atividades. Também é possível reorganizar as atividades conforme a prioridade escolhida pelo usuário, clicando no link "organize-se", logo abaixo da listagem, o sistema abrirá uma nova janela onde o usuário poderá arrastar e definir qual atividade será exibida primeiro.

Para realizar a consulta na API REST, basta acessar a rota: **http://meu-servidor/api/v1/atividade.json**. É possível acessar e ter a resposta em dois formatos, JSON ou XML:
```console
http://meu-servidor/api/v1/atividade.json
http://meu-servidor/api/v1/atividade.xml
```

Exemplos:
```console
GET - **http://meu-servidor/api/v1/atividade.json/1**
POST - **http://meu-servidor/api/v1/atividade.json** + data
PUT - **http://meu-servidor/api/v1/atividade.json/1** + data
DELETE - **http://meu-servidor/api/v1/atividade.json/1**
```

A seguir a resposta das atividades:
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

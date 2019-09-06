# API em PHP e Laravel / Users

É uma API construída em PHP e Laravel 5.8. Utiliza Passport para autenticação.

## Getting Started

Criação de API para treinamento, com um CRUD de usuários, a cada registro de novo usuário um email é enviado para usuário validar conta. Utilizado Passport para autenticação, Notification para notificação e Queue para enfileirar processo. Este lado do servidor não tem front-End desenvolvido. Todo desenvolvimento foi feito com utilização do Postman.

### Prerequisites

Você precisa ter instalado PHP e MySQL Server, além disso você deve ativar o módulo de Rewrite do seu servidor web. Se estiver utilizando Linux, muitas vezes o LAMP lhe apresentará todo ambiente perfeito. No Windows, muitos costumam utilizar o XAMP que também contém um servidor web apache.
Não faz parte desde documento, apresentar as etapas de instalação de cada elemento do ambiente de execução.

### Installing

Após baixar o código, se estiver compactado, extrai-os e coloque-os no diretório que pode ser lido por um servidor web ou em um diretório de sua preferencia para rodar com o servidor web embutido no php que pode ser invocado pelo artisan.

Logo em seguida, você deve executar o composer para instalação das dependências:

```

composer install


```
 
Você precisa configurar o arquivo .env informando os detalhes de conexão com banco de dados. Além disso ainda no arquivo .env, precisa configurar o QUEUE_CONNECTION=database
Também precisa definir as configurações de email, para que o fluxo de mensagens possa ocorrer. Para configuração de servidor de email, pode-se utilizar o Mailtrap.io

Uma vez configurado o arquivo .env. Execute os comandos:

```

php artisan key:generate

php artisan migrate --seed

```

Após isso, você precisa gerar as chaves do Oauth:

```

php artisan passport:install

```

Para executar o programa, se não estiver utizando um servidor web, inicie o servidor web embutido, utilizando o comando:

```
php artisan serve

```


### Usage

Feito as configurações acima, você precisa utilizar um client para invocar os endpoints. O arquivo api.php dentro do diretório routes, mostra as definições de rotas.

Alguns Endpoints (Necessário substituir o 127.0.0.1 pelo endereço correto do servidor. Configurações de cors já estão definidas):

* **HTTP POST** http://127.0.0.1/api/register
* **HTTP POST** http://127.0.0.1/api/login HTTP
* **HTTP GET** http://127.0.0.1/api/logout

#### API Resource: 

* **HTTP GET** http://127.0.0.1/api/users 
* **HTTP POST** http://127.0.0.1/api/users
* **HTTP GET** http://127.0.0.1/api/users/{id}
* **HTTP PUT** http://127.0.0.1/api/users/{id}
* **HTTP DELETE** http://127.0.0.1/api/users/{id}

Para alteração de senha, chaves: **old_password, new_password, new_password_confirmation**

* **HTTP PUT** http:///api/users/{id}/change-password 


## Authors

* **Alexandre Bezerra Barbosa**

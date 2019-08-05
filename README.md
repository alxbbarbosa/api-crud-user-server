# api-crud-user-server (AINDA ESTÁ EM DESENVOLVIMENTO)

Criação de API teste, com um CRUD de usuários, a cada registro de novo usuário um email é enviado para usuário validar conta.
Utilizado Passport para autenticação, Notification para notificação e Queue para enfileirar processo.
Este lado do servidor não tem front-End desenvolvido. Todo desenvolvimento foi feito com utilização do Postman.

Para funcionar conforme os testes:

Necessário configurar no .env:
 QUEUE_CONNECTION=database

Necessário definir configurações de servidor de email, podendo ser Mailtrap.io

Gerar as chaves do Oauth: php artisan passport:install

Alguns Endpoints:

HTTP POST http://<dominio>/api/register
HTTP POST http://<dominio>/api/login
HTTP GET http://<dominio>/api/logout

API Resource:
HTTP GET http://<dominio>/api/users
HTTP POST http://<dominio>/api/users
HTTP GET http://<dominio>/api/users/{id}
HTTP PUT http://<dominio>/api/users/{id}
HTTP DELETE http://<dominio>/api/users/{id}

HTTP PUT http://<dominio>/api/users/{id}/change-password
Para alteração de senha, chaves: old_password, new_password, new_password_confirmation
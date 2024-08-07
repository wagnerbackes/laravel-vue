Software de Gerenciamento de Cursos
-----------------------------------

Objetivo
--------

Desenvolver uma aplicação web para gerenciar cursos, incluindo interface de usuário (frontend) conectada à API REST.

**Requisitos**

* Linguagem de programação: PHP 7+
* Banco de dados MySQL
* Framework Vue 3+
* Framework Laravel 10+
* Ambiente Docker

**Entrega**

* Link compartilhável do repositório no Github
* README com instruções de execução do projeto
* Prazo de entrega: 1 semana

**Critérios de Avaliação**

* Estrutura do projeto e organização de código
* Boas práticas de desenvolvimento
* Clareza e objetividade na interface do usuário
* Funcionalidades de acordo com o contexto do desafio
* Validaciones de segurança e tratamentos de erros
* Autenticação entre front x back

**Subindo o Docker-Compose**
-----------------------------

Para subir o ambiente docker-compose, execute o comando abaixo:
```
docker-compose up -d
```

**Maquinas Usadas e Portas**
-------------------------

| Serviço | IP | Porta |
| --- | --- | --- |
| **db** | 172.18.0.2 | 3306 (exposed como 3333) |
| **backend (Laravel 10)** | 172.18.0.3 | 8000 (exposed como 82) |
| **frontend (Vue 3)** | 172.18.0.4 | 5173 |

**Seed do Laravel**
------------------

Após subir os containers, execute o comando abaixo:
```
docker-compose exec backend php artisan db:seed
```

Lembre-se de que é importante executar o comando `docker-compose up -d` antes de executar o seed, pois os containers precisam estar online para que o seed possa funcionar corretamente.

**Usuários de Teste**
----------------------

* **admin**: admin@admin (senha: admin)
* **fun**: fun@fun (senha: func)

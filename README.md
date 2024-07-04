# Простой конструктор блюд
Dockerized Symfony Application.

## Требования:
Для корректной работы необходимы следующие компоненты:
- [Docker](https://docs.docker.com/engine/install/);
- [Docker Compose](https://docs.docker.com/compose/install/#scenario-two-install-the-compose-plugin).

## Для запуска приложения:
1. Скачайте этот репозиторий на свой компьютер;
2. В консоли запустите команду `make env`;
3. В файле `.env.local` установите необходимые для БД `POSTGRES_` переменные (в `DATABASE_URL` так же необходимо прописать эти переменные);
4. В консоли запустите команду `make init` (подтверждайте действия нажатием Enter, при необходимости);
5. После успешной сборки в консоли запустите команду `make php` - откроется доступ к контейнеру приложения;
7. `php bin/console get:recipe:variants 'dccii'`, где `'dccii'` - код рецепта.

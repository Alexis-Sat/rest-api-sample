**Simple RestApi**

## Как запустить

1.  Склонируйте  на локальный компьютер.
    ```bash
    git clone ссылка на проект
    ```
2.  Скопируйте файл `.env.example` в `.env` и настройте его для своего окружения:
    ```bash
    cp .env.example .env
    ```
3.	Сгенерируйте или придумайте API_KEY и внесите его в .env

4.  Запустите контейнеры Docker:
    ```bash
    docker-compose up -d --build
    ```
5. Установите зависимости composer: 
 ```bash
    docker-compose exec rest-api composer install
 ```

Для публикации Swagger конфигурации (заполненный файл не изменится)

 ```bash
    docker-compose exec rest-api php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
 ```
Для генерации документации:
 ```bash
    docker-compose exec rest-api php artisan php artisan l5-swagger:generate
 ```

6. Выполните миграции базы данных:
```bash
    docker-compose exec rest-api php artisan migrate --seed
```

7. Документация Swagger доступна по 'api/documentation' (http://localhost:8300/api/documentation). Для проверки маршрутов необходимо вносить token = ваш API_KEY в заголовок запроса




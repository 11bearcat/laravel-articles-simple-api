Документация:

#1. Настроить подключение к БД в .env файле.

#2. Запустить команды
-------
    1. composer install
-------
    2. php artisan migrate --seed
-------
    3. php artisan serve
-------
#3. API методы:

---------------------------------------------------------------------------------

    1. Получение списка постов  (uri: 'api/v1/articles', method: 'GET')
        Тело запроса: {}
        Ответ сервера: json
           
---------------------------------------------------------------------------------

    2. Создать пост (uri: 'api/v1/articles', method: 'POST')
        Тело запроса: 
            {
                "title": "new22221222",
                "text": "textsdsdsdsd",
                "tags": [
                    {
                        "title": "new222222"
                    },
                    {
                        "title": "new223"
                    }
                ]
            }

        Ответ сервера: Вернет созданный объект.

-----------------------------------------------------------------------------------

    3. Получение поста (uri: 'api/v1/articles/{id}', method: 'GET')
        Тело запроса: {}.
        Ответ от сервера: 
            {
                "data": {
                    "id": 2,
                    "title": "Peggie Langworth",
                    "text": "Error est eveniet sint ut eum ipsa. Voluptas possimus dolores et beatae. Rerum quis dolorem qui id dicta esse et. Qui aspernatur omnis iusto itaque iure corporis praesentium.",
                    "created_at": "2021-08-14T13:41:50.000000Z",
                    "tags": [
                        {
                            "id": 1,
                            "title": "Heather Luettgen",
                            "created_at": "2021-08-14T13:41:50.000000Z"
                        }
                    ]
                }
            }

-----------------------------------------------------------------------------------

    4. Редактировать пост (uri: 'api/v1/articles/{id}', method: 'POST')
        Тело запроса: 
            {
                "title": "new22221222",
                "text": "textsdsdsdsd",
                "tags": [
                    {
                        "title": "new222222"
                    },
                    {
                        "title": "new223"
                    }
                ]
            }.

        Ответ сервера: Вернет отредактированый пост
        
-----------------------------------------------------------------------------------

    5. Удалить пост (uri: 'api/v1/articles/{id}', method: 'DELETE')
        Тело запроса: {}
        Ответ сервера: Статус 204

-----------------------------------------------------------------------------------

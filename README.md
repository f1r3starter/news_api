# Rest API для создания статей и категорий статей

## Доступные методы

- GET /api/[v1|v2]/posts
- POST /api/[v1|v2]/posts
- PUT /api/[v1|v2]/posts/{id}
- DELETE /api/[v1|v2]/posts/{id}
- GET /api/[v1|v2]/categories

## Описание

В проекте присутствует две версии API. Первая сделана чисто средствами Yii. Преимуществами такого подхода является быстрота и простота разработки. Недостатками - высокая связанность классов и использование встроенного сервис локатора. Так же данное решение очень зависимо от самого фреймворка и от ActiveRecord.

Вторая версия ближе к DDD. Использует DI (файл [Bootstrap](https://github.com/f1r3starter/news_api/blob/master/bootstrap/Bootstrap.php)), что значительно уменьшает неявные зависимости от сервис локатора. Работа с данными вынесена в репозитории, чистый sql был выбран просто чтобы реализовать репозиторий без ActiveRecord, можно использовать любую ORM, реализуя интерфейс репозитория. Валидация реализована с помощью чистой модели Yii, без ActiveRecord. Кеширование происходит в слое сервисов, инвалидация кеша реализована с помощью ивентов, которые передаются диспатчером нужному слушателю. В целом, такой подход значительно усложнил приложение, зато сделал код более фреймворконезависимым.

Чтобы запустить проект, выполните команду:

   `docker-compose up`
<?php

/* @var $this yii\web\View */

$this->title = 'REST';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Rest API для создания статей и категорий статей</h1>

        <p class="lead">Доступны методы:</p>

        <ul class="list-group">
            <li class="list-group-item">GET /api/[v1|v2]/posts</li>
            <li class="list-group-item">POST /api/[v1|v2]/posts</li>
            <li class="list-group-item">PUT /api/[v1|v2]/posts/{id}</li>
            <li class="list-group-item">DELETE /api/[v1|v2]/posts/{id}</li>
            <li class="list-group-item">GET /api/[v1|v2]/categories</li>
        </ul>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <p>В проекте присутствует две версии API. Первая сделана чисто средствами Yii. Преимуществами такого подхода является быстрота и простота разработки. Недостатками - высокая связанность классов и использование встроенного сервис локатора. Так же данное решение очень зависимо от самого фреймворка и от ActiveRecord. </p>
            </div>
            <div class="col-lg-6">
                <p>Вторая версия ближе к DDD. Использует DI (файл Bootstrap), что значительно уменьшает неявные зависимости от сервис локатора. Работа с данными вынесена в репозитории, чистый sql был выбран просто чтобы реализовать репозиторий без ActiveRecord, можно использовать любую ORM, реализуя интерфейс репозитория. Валидация реализована с помощью чистой модели Yii, без ActiveRecord. Кеширование происходит в слое сервисов, инвалидация кеша реализована с помощью ивентов, которые передаются диспатчером нужному слушателю. В целом, такой подход значительно усложнил приложение, зато сделал код более фреймворконезависимым.</p>
            </div>
        </div>

    </div>
</div>

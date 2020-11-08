Magento 2 Docker
================

Зміст
-----
- [Реєстр готових (pre-build) PHP імеджів](#реєстр-готових-pre-build-php-імеджів)
- [E-MAIL](#e-mail)
- [Генерація SSL сертифікатів](#генерація-ssl-сертифікатів)
- [Додаткові домени](#додаткові-домени)
- [Конфігурація та параметри](#конфігурація-та-параметри)
- [Переглянути активні контейнери](#переглянути-активні-контейнери)
- [CLI в контейнері](#cli-в-контейнері)
- [Використання Docker-compose](#використання-docker-compose)
- [Завантаження Magento](#завантаження-magento)
- [Права доступу до директорій](#права-доступу-до-директорій)
- [Встановлення Magento](#встановлення-magento)
- [Використання контейнера для існуючого проекту Magento](#використання-контейнера-для-існуючого-проекту-magento)
- [Імпорт бази даних з backup-файлу](#імпорт-бази-даних-з-backup-файлу)
- [Backup (dump) бази у файл](#backup-dump-бази-у-файл)
- [Видалити DEFINER з dump файлу](#видалити-definer-з-dump-файлу)
- [Генерація SSL сертифікатів (ручний режим)](#генерація-ssl-сертифікатів-ручний-режим)
- [Налаштування Xdebug для CLI](#налаштування-xdebug-для-cli)
- [Встановлення додаткових бібліотек і екстеншенів в імедж](#встановлення-додаткових-бібліотек-і-екстеншенів-в-імедж)

Реєстр готових (pre-build) PHP імеджів
--------------------------------------
Всі доступні версії PHP контейнерів доступні за посиланням: [`https://web.docker.pp.ua/#!taglist/magento2-php`](https://web.docker.pp.ua/#!taglist/magento2-php)

*__Примітка__: також можете переглянути репозиторій за посиланням [https://web.docker.pp.ua/](https://web.docker.pp.ua/)*

E-MAIL
------
Для листів встановлена локальна заглушка, яка не дозволить відправити лист в Internet, а лише збереже його локально для перегляду.

Переглянути всі отримані листи можна за посиланням: [`http://localhost:8025/`](http://localhost:8025/)

![](https://i.imgur.com/GaarM5O.png)

Генерація SSL сертифікатів
--------------------------
*__Примітка__: виконуємо у локальному терміналі*

В останній ревізії контейнера при запуску **`docker-compose up`** реалізований механізм автоматичного створення сертифікатів по параметру `VIRTUAL_HOST`:
- ![](https://i.imgur.com/OyIW6X8.png)
- додати `0.0.0.0 magento2.dev` до `/etc/hosts` файлу

*__Примітка__: також є можливість генерації в ручному режимі, див. секцію [`Генерація SSL сертифікатів (ручний режим)`](#генерація-ssl-сертифікатів-ручний-режим)*

Додаткові домени
----------------
Конфігурація додаткових доменів реалізована через `DOMAINS` параметр у файлі `docker-compose.yml`:
- ![](https://i.imgur.com/KYXdZhs.png)

Для того щоб додати новий домен потрібно вказати його у форматі:
- `domain=store_code` - див. секцію [`Конфігурація та параметри`](#конфігурація-та-параметри) (`domain=website_code` - в залежності від параметра `MAGE_RUN_TYPE`)
- при додаванні декількох доменів їх потрібно розділяти пробілом `domain1=store_code1 domain2=store_code2`
- при запуску контейнера конфігурації та сертифікати для доментів будуть згенеровані автоматично
- ![](https://i.imgur.com/MKnXSAj.png)
- ![](https://i.imgur.com/P5rU70C.png)
- додати `0.0.0.0 domain_name` до `/etc/hosts` файлу
- налаштувати `base_url` відповідним чином

Конфігурація та параметри
-------------------------
Для конфігурування Magento використовуються наступні параметри:

![](https://i.imgur.com/QAUICmD.png)

- `VIRTUAL_HOST` - хостнейм, який буде використовуватись як адреса веб-сайту
- `MAGE_MODE` - режим роботи Magento (`default`, `developer`, `production`, `maintenance`)
- `MAGE_RUN_TYPE` - тип коду для ініціалізації (`store`, `website`)
- `MAGE_RUN_CODE` - код store або website (залежить від параметра `MAGE_RUN_TYPE`), який буде використовуватись для ініціалізації Magento.

Примітка:
- `MAGE_RUN_TYPE =`**`store`**
    - `MAGE_RUN_CODE` дивитись БД у таблиці `store`
    - ![](https://i.imgur.com/BSjJBXc.png)

- `MAGE_RUN_TYPE =`**`website`**:
    - `MAGE_RUN_CODE` дивитись БД у таблиці `store_website`
    - ![](https://i.imgur.com/GlJaahP.png)

Переглянути активні контейнери
------------------------------
*__Примітка__: виконуємо у локальному терміналі*

Команда **`docker ps`**

![](https://i.imgur.com/l5WV11H.png)

- `CONTAINER ID` - ID контейнера
- `IMAGE` - образ контейнера на якому він працює
- `COMMAND` - головна команда контейнера (задається при створенні в `Dockerfile`)
- `CREATED` - дата створення
- `STATUS` - час роботи від старту
- `PORTS` - показує як локальний (доступний на ПК) порт співвідноситься до порту в контейнері Docker
- `NAMES` - ім'я контейнера - використовується у командах по роботі з контейнером

CLI в контейнері
----------------
Як заходити в PHP контейнер, щоб не зіпсувати права доступу:

**`docker exec -ti magento2_php su www-data -s /bin/bash`** - за допомогою цієї команди ви відкриєте CLI контейнера і там вже виконувати усі решту маніпуляції
- `magento2_php` - ім'я контейнера PHP (див. секцію [`Переглянути активні контейнери`](#переглянути-активні-контейнери))

Використання Docker-compose
---------------------------
*__Примітка__: виконуємо у локальному терміналі*

- Клонуємо GIT-репозиторій на локальний комп'ютер: **`git clone https://github.pp.ua/anbis/docker-magento2.git`**
- Переходимо у директорію, яка була створена у попередньому пункті **`cd docker-magento2`**
- Запускаємо контейнери **`docker-compose up`**
- Перевіряємо статус контейнерів **`docker ps`** (у новому вікні терміналу): 
    - має бути активно декілька контейнерів (`nginx`, `php`, `mysql`, `mailhog`, `redis`, `elasticsearch`...)
    - ![](https://i.imgur.com/sJxjcgs.png)
- переходимо в контейнер PHP **`docker exec -ti magento2_php bash`**

Завантаження Magento
--------------------
*__Примітка__: виконуємо у контейнері PHP*

- за допомогою **`СOMPOSER`**
    - **`composer create-project --repository-url=https://repo.magento.com/ magento/project-community-edition`** - завантажуємо файли за допомогою Composer
    - **`mv project-community-edition/{*,.*} .`** - переміщуємо файли на рівень нижче (можуть бути повідомлення про помилку - ігноруємо)
    - **`rm -rf project-community-edition`** - видаляємо директорію, вона нам більше не потрібна
    - **`chown -R www-data:www-data .`** - змінюємо права доступу після завантаження на коректні
    - **`exit`** - виходимо з терміналу контейнера
    
- за допомогою **`GIT`**
    - to be continued...
    
Права доступу до директорій
---------------------------
*__Примітка__: виконуємо у локальному терміналі*

Для правильної роботи Magento необхідно надати право на запис у наступні директорії:
- `var`
- `app/etc`
- `pub/media`
- `pub/static`

Для цього необхідно виконати команду (знаходитись у директорії проекту):
- **`sudo chmod -R 777 code/var code/app/etc code/pub/media code/pub/static`**
- **`sudo chown -R $USER:$USER code`**

Встановлення Magento
--------------------
*__Примітка__: виконуємо у контейнері PHP*

- **`bin/magento`** - перевіряємо чи працює консоль Magento
    - ![](https://i.imgur.com/jVwRPRS.png)
- **`bin/magento setup:install --db-host=magento2_mysql --db-name=magento2 --db-user=magento2 --db-password=magento2 --search-engine=elasticsearch6 --elasticsearch-host=http://magento2_elasticsearch:9200 --elasticsearch-port=9200 --elasticsearch-enable-auth=0 --session-save=redis --session-save-redis-host=magento2_redis --session-save-redis-port=6379 --session-save-redis-db=1 --cache-backend=redis --cache-backend-redis-server=magento2_redis --cache-backend-redis-port=6379 --cache-backend-redis-db=2 --admin-user=anbis --admin-password=magent0 --admin-email=test@example.com --admin-firstname=name --admin-lastname=surname --base-url=https://magento2.dev/ --backend-frontname=admin --language=en_US --currency=USD --timezone=America/Chicago --cleanup-database --use-rewrites=1`**
    - `db-host=magento2_mysql` - хост бази даних (БД)
    - `db-user=magento2` - користувач БД
    - `db-password=magento2` - пароль користувача БД
    - `db-name=magento2` - назва БД
    - `search-engine=elasticsearch6` - використовувати пошуковий сервер ElasticSearch6
    - `elasticsearch-host=http://magento2_elasticsearch:9200` - хост ElasticSearch
    - `elasticsearch-port=9200` - порт ElasticSearch
    - `elasticsearch-enable-auth=0` - не використовувати аутентифікацію ElasticSearch
    - `session-save=redis` - використовувати Redis для зберігання сесій
    - `session-save-redis-host=magento2_redis` - хост Redis
    - `session-save-redis-port=6379` - порт Redis
    - `session-save-redis-db=1` - БД Redis
    - `cache-backend=redis` - використовувати Redis для зберігання кешу
    - `cache-backend-redis-server=magento2_redis` - хост Redis
    - `cache-backend-redis-port=6379` - порт Redis
    - `cache-backend-redis-db=2` - БД Redis
    - `admin-user=anbis` - користувач для адмін-панелі
    - `admin-password=magent0` - пароль користувача адмін-панелі
    - `admin-email=test@example.com` - email користувача адмін-панелі
    - `admin-firstname=name` - ім'я користувача адмін-панелі
    - `admin-lastname=surname` - прізвище користувача адмін-панелі
    - `base-url=https://magento2.dev/` - URL для доступу Magento з браузера (`magento2.dev`, `magento2.local`, `magento2.test`)
    - `backend-frontname=admin` - URL-постфікс для доступу в адмін-панель
    - `language=en_US` - локаль магазину
    - `currency=USD` - валюта магазину
    - `timezone=America/Chicago` - часова зона магазину
    - `cleanup-database` - очистити базу перед встановленням Magento
    - `use-rewrites=1` - використовувати SEO-friendly URL для категорій і продуктів
- ![](https://i.imgur.com/JrApk26.png)
    
- перейти по URL, який був вказаний в параметрі `base-url` ([`https://magento2.dev/`](https://magento2.dev/))
    - ![](https://i.imgur.com/RFHAAvK.png)

Використання контейнера для існуючого проекту Magento
-----------------------------------------------------
*__Примітка__: виконуємо у контейнері PHP*

- створити директорію `code` у директорії з проектом
- копіювати або перенести усі файли Magento у директорію `code`
- імортувати БД з файлу
- перевірити коректні налаштування файлу `app/etc/env.php` (файл-примірник `env.php.example`)
- якщо директорія `vendor` порожня - виконати в команду **`composer install`**
- за необхідності встановити коректні права доступу до директорій
- виконати **`bin/magento setup:upgrade`**
- **`bin/magento setup:store-config:set --base-url="http://magento2.dev/"`**
- **`bin/magento setup:store-config:set --base-url-secure="https://magento2.dev/"`**
- **`bin/magento cache:flush`**
- додати `0.0.0.0 magento2.dev` до `/etc/hosts` файлу
    
Імпорт бази даних з backup-файлу
--------------------------------
*__Примітка__: виконуємо у локальному терміналі*

**`cat backup.sql | docker exec -i CONTAINER_NAME /usr/bin/mysql -u ROOT --password=PASSWORD DATABASE`**:
- `backup.sql` - файл для імпорту
- `CONTAINER_NAME` - контейнер з MySQL (по замовчуванню `magento2_mysql`)
- `ROOT` - ім'я користувача MySQL (по замовчуванню `root`)
- `PASSWORD` - пароль користувача MySQL (по замовчуванню `magento2`)
- `DATABASE` - база данних MySQL (по замовчуванню `magento2`)

Backup (dump) бази у файл
-------------------------
*__Примітка__: виконуємо у локальному терміналі*

**`docker exec CONTAINER_NAME /usr/bin/mysqldump -u ROOT --password=PASSWORD DATABASE > backup.sql`**:
- `CONTAINER_NAME` - контейнер з MySQL (по замовчуванню `magento2_mysql`)
- `ROOT` - ім'я користувача MySQL (по замовчуванню `root`)
- `PASSWORD` - пароль користувача MySQL (по замовчуванню `magento2`)
- `DATABASE` - база данних MySQL (по замовчуванню `magento2`)
- `backup.sql` - файл для імпорту

Видалити DEFINER з dump файлу
-----------------------------
*__Примітка__: виконуємо у локальному терміналі*

**`cat backup_WITH_definers.sql | sed -e 's/DEFINER[ ]*=[ ]*[^*]*\*/\*/' > backup_WITHOUT_definers.sql`**
- `backup_WITH_definers` - файл з дефайнерами
- `backup_WITHOUT_definers` - файл для імпорту, який вже не містить дефайнерів

Генерація SSL сертифікатів (ручний режим)
-----------------------------------------
*__Примітка__: виконуємо у локальному терміналі*

Для генерації сертифіката потрібно:
- перейти в директорію **`cd ssl/ssl_generator`**
- виконати команду **`./create.sh sample.test`**, де:
    - `sample.test` - хост для якого потрібно згенерувати сертифікат
    - ![](https://i.imgur.com/oxl7utN.png)
- повинна створитись нова директорія з вашим хостом:
    - ![](https://i.imgur.com/Zx4t8qz.png)
- необхідно вказати цей хост у `docker-compose.yml` файлі:
    - ![](https://i.imgur.com/VXdd8JB.png)
- імпортувати кореневий сертифікат в браузер, для того щоб браузер міг довіряти самопідписаним сертифікатам:
    - Chrome - Settings - [Privacy and security] Security - [Advanced] Manage certificates - Authorities
    - натиснути кнопку Import
    - ![](https://i.imgur.com/BjtlZ9X.png)
    - перейти у директорію з проектом `docker-magento2/ssl/ssl_generator`
    - змінити фільтр на `All Files`
    - ![](https://i.imgur.com/jsJOSJR.png)
    - вибрати файл `rootCA.crt`
    - відмітити 3 чекбокси і натиснути ОК
    - ![](https://i.imgur.com/hjMKC8T.png)
- додати `0.0.0.0 sample.test` до `/etc/hosts` файлу
- готово
    - ![](https://i.imgur.com/mBxnMks.png)

Налаштування Xdebug для CLI
---------------------------
- **`docker inspect magento2_php`**
- ![](https://i.imgur.com/v1J5RHa.png)
- ![](https://i.imgur.com/jTtsn44.png)
- **`docker-compose stop`**
- **`docker-compose up`**
- ![](https://i.imgur.com/FBuzn9j.png)
- включити PHP Storm - Run - Break at first line in PHP scripts
- включити Listener Xdebug
- готово
- ![](https://i.imgur.com/8DSISpl.png)

Встановлення додаткових бібліотек і екстеншенів в імедж
-------------------------------------------------------
*__Примітка__: виконуємо у локальному терміналі*

- закоментувати стрічку з `image: docker.pp.ua/magento2-....`
- розкоментувати стрічку з `build: ./builds-custom/....`
- ![](https://i.imgur.com/psoVNUF.png)
- відкрити та редагувати `Dockerfile` файл у директорії `builds-custom` і відповідний імедж (наприклад `php` - `builds-custom/php/Dockerfile`)
- ![](https://i.imgur.com/pvD4EK3.png)
- **`docker-compose stop`**
- **`docker-compose up --force-recreate --build`**
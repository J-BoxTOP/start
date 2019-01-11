<?php
/**
 * Created by PhpStorm.
 * User: shaxcom
 * Date: 22.12.18
 * Time: 12:15
 
 Разница в наклоне / или \ 
 
 */

        =====================

        - УСТАНОВКА ORACLE JAVA 8 UBUNTU
        sudo apt remove openjdk*
        sudo add-apt-repository ppa:webupd8team/java
        sudo apt-get update
        sudo apt-get install java-common oracle-java8-installer
        sudo apt-get install oracle-java8-set-default
        source /etc/profile

        =====================

        - Установка Composer
        sudo apt install php7.0-cli git
        curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
        sudo chown -R $USER $HOME/.composer
        sudo /usr/bin/composer self-update
        composer

        =====================

        GitHub
        JboxCOM
        jbox.top.web@gmail.com
        Shax_04062002

        =====================

        - Установка Git
        sudo apt install git

        Добавление в готовый рипозиторий
        git clone https://github.com/USER/demo.git
        git add .
        git status
        git commit -m "Add project"
        -- git config --global user.email "jbox.top.web@gmail.com"
        -- git config --global user.name "JboxCOM"
        git tag v1.0
        git push
        git push --tags
        git config --global push.default simple

        Добавление в новый рипозиторий
        git init
        git add .
        git commit -m "Init"
        -- git config --global user.email "jbox.top.web@gmail.com"
        -- git config --global user.name "JboxCOM"
        git remote add origin https://github.com/J-BoxTOP/start.git
        git push -u origin master

        ===================

        Vagrant установка со скаченого файла на офиц сайте - vagrant_2.2.2_x86_64.deb
        -Установка плагинов Vagrant
        vagrant plugin install vagrant-vbguest
        vagrant plugin install vagrant-hostmanager

        =====================

          Исключаем из поика и замены папки проекта (красным цвветом)

            .vagrant
            backent/ runteim
            backent/ web/ asset
            console/ runteim
            frontend/ runteim
            frontend/ web/ asset

          Указываеем  исходники (синим цветом)

            backent
            console
            frontend
            common

          Указываем папки задействованы в тестах

            backent/ test
            frontend/ test
            common/ test

         Указание интерпретатора

         Указание composer



         Вставляем токен с GitHub в vagrant-local.example.yml

         изменяем изменяем имена доменов в файлах Yii2

         при желании меняем версию PHP

         vagrant plugin install vagrant-vbguest  - устанавливает плагины

         Запускаем Vagrant


================================================

        sudo rm -rf / opt / vagrant / embedded / bin / curl  - убирает ssh

        Подъем вируалки

        Подключение через ssh (меню tools)

        sudo apt install mc - установка командера
        mc - запуск

         Установка Curl

            $ sudo add-apt-repository ppa:costamagnagianfranco/ettercap-stable-backports
            $ sudo apt-get update
            $ sudo apt-get install curl

         Находим php.ini в консоли - $ locate php.ini
         /etc/php/7.0/cli/php.ini
         раскоментируем строку - extension=php_curl.dll
         Обновляем все что можно через консоль - $ sudo apt-get install php7.0-curl php7.0-mbstring php7.0-pgsql php7.0-intl
         Перезагружаем сервер

================================================

       Раскоментируем  в  backent/config/mmain.php и добавляем правила ЧПУ ссылок




        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
		        '' => 'site/index',
		        '<_a:login|logout>' =>  'site/<_a>',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
                '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
            ],
        ],

 Навешиваем поведение через "as"  контрол работает на весь проек
     
        'as access' => [
            'class' => 'yii\filters\AccessControl',
            'except' => ['site/login', 'site/error'], /* - вход только зарегестрированым пользователям кроме страниц login и error */
            'rules' => [
                [
                    'allow' => true,  /*- доступ для всех экшенов, только для залдлогиненных пользователей*/
                    'roles' => ['@'],
                ],
            ],
        ],

Удаляем поведение из backend/controllers/SiteController.php

            'access' => [
    'class' => AccessControl::className(),
    'rules' => [
        [
            'actions' => ['login', 'error'],
            'allow' => true,
        ],
        [
            'actions' => ['logout', 'index'],
            'allow' => true,
            'roles' => ['@'],
        ],
    ],
],

================================================
  База данных
  Вкладка database открываем и создаем базу данных MySQL
  Вносим ip сервера, название базы данных, user.
  Подключаем.
  Регестрируемся на сайте смотри в базе данных нового пользователя.

================================================
    
  vagrant ssh -- 'cd /app && /usr/bin/php /app/vendor/bin/codecept run unit -- -c common'
  НИХУЯ не работает будем тестить позже - PHP Warning:  require_once(/app/vendor/bin/autoload.php):
  time - 3.13

================================================
      
  Формирование общего cookies для backend и frontend (Общая авторизация)

  1. Добавляем в 'common/config/params.php'
     'cookieDomain' => '.example.com',


  2. В 'common/config/params-local.php', прописываеи  общий для backend и frontend:
          'cookieValidationKey' => 'NEL5FyFNMiAe8Yt5s0WKnG_wkbeUOfqh',
          'cookieDomain' => '.shop.test',

  3. Указываем путь к новым общим параметрам в environments/index.php
        'setCookieValidationKey' => [
            'common/config/params-local.php',
        ],
  4. В backend/config/main прописываем
      а) в 'request' вставляем  - 'cookieValidationKey' => $params['cookieValidationKey'],

      в) У User 'identityCookie' прописываем cookieDomain
          'domain' => $params['cookieDomain'],

      с) в сесии прописываем параметры cookie
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true
            ]
      Повторяем все в frontend

  time - 3.17
          
Создание сквозного UrlManagera для отдовременой отправки письма колиенту и покупателю из backend и frontend
          
    1. Создается файл UrlManager.php в backend.
        return[
            'class' => 'yii\web\UrlManager',
            'hostInfo' => $params['backendHostInfo'],
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<_a:login|logout>' =>  'site/<_a>',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
                '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
            ],
        ];

    2. 1. Создается файл UrlManager.php в frontend.
        return[
            'class' => 'yii\web\UrlManager',
            'hostInfo' => $params['frontendHostInfo'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<_a:login|logout>' =>  'site/<_a>',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
                '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
            ],
        ];


    3. Реквайрим main.php в backend.
        
        'backendUrlManager' => require __DIR__ . '/urlManager.php',
        'frontendUrlManager' => require __DIR__ . '/../../frontend/config/urlManager.php',
        'urlManager' => function () {
            return Yii::$app->get('backendUrlManager');
         },

    4. Реквайрим main.php в frontend.
        
        'backendUrlManager' => require __DIR__ . '/../../backend/config/urlManager.php',
        'frontendUrlManager' => require __DIR__ . '/urlManager.php',
        'urlManager' => function () {
            return Yii::$app->get('frontendUrlManager');
        },

    5. Подключаем оба UrlManagerа в main.php в console.
        
        'backendUrlManager' => require __DIR__ . '/../../backend/config/urlManager.php',
        'frontendUrlManager' => require __DIR__ . '/../../frontend/config/urlManager.php',

    6. Прописываем параметры по умолчанию для адреса проекта в common/config/params.php
        'frondHostInfo' => 'http://example.com',
        'backendHostInfo' => 'http://backend.example.com',

time - 3.34
    
    Устанавливаем memcached. Прописываем в консоли вирт образа.
    sudo apt install php7.0-memcached memcached
    Так же можно добавить в файл once-as-root.sh
    php7.0-memcached memcached














































































































































































































































































































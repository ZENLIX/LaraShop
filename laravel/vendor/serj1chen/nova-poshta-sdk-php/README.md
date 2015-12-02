# Новая почта. SDK для личного кабинета API 2

Для быстрого оформления большого количества отправлений используется способ электронного обмена данными между
информационной системой компании «Новая Почта» и программным комплексом Партнера/Клиента. Обмен данными
осуществляется путем передачи информации через программную среду АРІ.

Для начала работы с функционалом АРІ компании «Новая Почта» необходимо создать ключ на странице настройки в личном
кабинете my.novaposhta.ua. Ключ АРІ обязательно включается в каждый запрос.
Важно! Все создаваемые ключи ограничены во времени действия, настоятельно рекомендуется учитывать данное ограничение.

SDK разработана по официальной документации. За более детальной информацией по описанию моделей и методов обращайтесь
на страницу официальной документации API 2 личного кабинета: [Новой почты]. SDK не является официальным SDK Новой
почты, я его разработал в личных целях.

## Подключить SDK

### Способ 1 (composer)

Самый простой способ установить SDK через composer.

Создайте файл `composer.json` в корне Вашего проекта:
 
      {
          "require": {
              "serj1chen/nova-poshta-sdk-php": "2.0.*"
          }
      }

Установить composer:

      $ curl -sS https://getcomposer.org/installer | php
      $ php composer.phar install

Подключить автолоадер composer:

      include_once "vendor/autoload.php";
      
      
### Способ 2 (git)

Клонировать репозиторий

      git clone git://github.com/serj1chen/nova-poshta-sdk-php
      
Подключить автолоадер SDK:

      include_once "nova-poshta-sdk-php/lib/NovaPoshta/bootstrap.php";

## Структура SDK

### Настройка файла конфигурации ([Config])
Перед тем как начать работать с API, нужно настроить файл конфигурации:

       Use NovaPoshta\Config;
       
       Config::setApiKey('<Ваш ключ>');
       Config::setFormat(Config::FORMAT_JSONRPC2);
       Config::setLanguage(Config::LANGUAGE_UA);
      
Пример: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Config_example.php]

Возможные форматы передачи данных (формат указывать  в метод setFormat):

- FORMAT_JSON
- FORMAT_JSONRPC2 (рекомендую)
- FORMAT_XML

### Работа с моделями SDK ([ApiModels])

Все модели лежат в папке [ApiModels].

Модели:

- Address: Модель для работы с адресами. Пример: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Address_example.php]
- Common: Модель для работы со справочниками. Пример: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Common_example.php]
- ContactPerson: Модель для создания контактного лица. Пример: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/ContactPerson_example.php]
- Counterparty: Модель для работы с данными контрагента. Пример: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Counterparty_example.php]
- InternetDocument: Модель для оформления отправлений. Пример: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/InternetDocument_example.php]
- ScanSheet: Модель для работы с реестрами приема-передачи отправлений. Пример: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/ScanSheet_example.php]

В классах моделей описаны все методы в комментариях.

### Работа с методами моделей

<b>Работа с методами модели: save, update, delete.</b> Заполнить модель нужными значениями и вызвать нужный метод. Пример:

      use NovaPoshta\ApiModels\Counterparty;
      
      $counterparty = new Counterparty();
      $counterparty->setCounterpartyProperty('Recipient');
      $counterparty->setCityRef('db5c88d0-391c-11dd-90d9-001a92567626');
      $counterparty->setCounterpartyType('PrivatePerson');
      $counterparty->setFirstName('Пилипко');
      $counterparty->setLastName('Вася');
      $counterparty->setMiddleName('Сергеевич');
      $counterparty->setPhone('+380661122333');
      $counterparty->setEmail('test@i.ua');
      
      $result = $counterparty->save();

<b>Работа с статическими методами.</b> В методы передавать объект MethodParameters:

      use NovaPoshta\ApiModels\Counterparty;
      use NovaPoshta\MethodParameters\MethodParameters;
      
      $data = new MethodParameters();
      $data->CounterpartyProperty = 'Recipient';
      $data->Page = 1;
      $data->CityRef = '8d5a980d-391c-11dd-90d9-001a92567626';
      $data->FindByString = 'Петр';
   
      $result = Counterparty::getCounterparties($data);
  
Или можно использовать классы [MethodParameters], которые наследуются от класса MethodParameters.
Классы имеют сеттеры параметров, которые можно передать статическому методу модели. Названия классов с параметрами 
складываются с двух частей, с названия модели ([ApiModels]) и названия статического метода модели. Пример использования:

      use NovaPoshta\ApiModels\Counterparty;
      use NovaPoshta\MethodParameters\MethodParameters;
      use NovaPoshta\MethodParameters\Counterparty_getCounterparties;
      
      $data = new Counterparty_getCounterparties();
      $data->setCounterpartyProperty('Recipient');
      $data->setPage(1);
      $data->setCityRef('8d5a980d-391c-11dd-90d9-001a92567626');
      $data->setFindByString('Петр');
   
      $result = Counterparty::getCounterparties($data);

### Модели хелперы для работы с моделями ([Models])

Данные классы нужны для заполнения моделей ([ApiModels])

### Логирования ([Logger])

Если Вам нужно логировать данные отправки/получения запросов. Нужно создать класс который наследуется от [Logger.php]
и передать экземпляр этого класса в метод setClassLogger файла [Config.php].

      use NovaPoshta\Config;
      
      Config::setClassLogger(new Logger_example());  

Пример класса логирования: [https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Logger_example.php].
(Соответственно у Вас будут данные куда-то записываться)

Метод <b>setOriginalData</b>: запрос/ответ API Новой почты.
Параметры: toData - запрос (тип: string); fromData - ответ (тип: string).

Метод <b>setData</b>: запрос/ответ API Новой почты у формате SDK.
Параметры: toData - запрос (объект: [DataContainer]); fromData - ответ (объект: [DataContainerResponse]).



** SDK не является официальным SDK Новой почты


License
----

MIT






[Новой почты]:https://my.novaposhta.ua
[ApiModels]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/tree/master/lib/NovaPoshta/ApiModels
[MethodParameters]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/tree/master/lib/NovaPoshta/MethodParameters
[Config]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/lib/NovaPoshta/Config.php
[Config.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/lib/NovaPoshta/Config.php
[Models]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/tree/master/lib/NovaPoshta/Models
[Logger]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/lib/NovaPoshta/Logger.php
[Logger.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/lib/NovaPoshta/Logger.php
[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Config_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Config_example.php
[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Logger_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Logger_example.php
[DataContainer]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/lib/NovaPoshta/Models/DataContainer.php
[DataContainerResponse]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/lib/NovaPoshta/Models/DataContainerResponse.php

[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/InternetDocument_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/InternetDocument_example.php
[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Address_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Address_example.php
[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Common_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Common_example.php
[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/ContactPerson_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/ContactPerson_example.php
[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Counterparty_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/Counterparty_example.php
[https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/ScanSheet_example.php]:https://github.com/serj1chen/NovaPoshta-SDK-PHP/blob/master/example/ScanSheet_example.php





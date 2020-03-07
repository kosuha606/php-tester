Tester
---

Маленкая библиотека для проведения тестов в runtime приложения

### Установка

Для установки можно использовать composer:
```bash
$ composer require kosuha606/php-tester
```

### Quick Start

Использовать достаточно просто.

Во-первых, создаем экземпляр объекта Tester, либо получаем
экземпляр из DIC.
```php
$tester = new Tester();
```

Во-вторых, передаем в $tester конфиграцию тестов, в формате
НазваниеКласса => ВызываемаяКонструкция.

```php
$tester->setTestMap(
[
    Object::class => function($object) {
        // тестируем $object
    }
]
);
```

Далее, в местах где важно протестировать объект перед использованием
выполныем такой код:

```php
// get запустит тесты
$object = $tester->get(new Object());

// Если $object прошел тесты то условие выполнится
if ($tester->passed($object)) {
    $object->usefulMethod();
}
```

### PS

Класс Tester реализует интерфейс ContainerInterface для
того, чтобы в IDE работал Автокомплит после возвращения
объекта через метод Tester::get()

### License
MIT

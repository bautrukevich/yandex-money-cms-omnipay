# yandex-money-cms-omnipay

Модуль оплаты yandexmoney-omnipay необходим для интеграции с сервисом [Яндекс.Касса](http://kassa.yandex.ru/) на базе [Omnipay](http://omnipay.thephpleague.com/).

 Доступные платежные методы, если вы работаете как юридические лицо:
* **Банковские карты** -  Visa (включая Electron), MasterCard и Maestro любого банка мира
* **Электронные деньги** - Яндекс.Деньги и WebMoney
* **Наличные** - [Более 170 тысяч пунктов](https://money.yandex.ru/pay/doc.xml?id=526209) оплаты по России
* **Баланс телефона** - Билайн, МегаФон и МТС
* **Интернет банкинг** - Альфа-Клик, Сбербанк Онлайн, Промсвязьбанк и MasterPass

### Поддержка передачи данных чека
Если вы настраивали отправку чеков в налоговую через партнеров Яндекс.Кассы (по 54-ФЗ), в настройках модуля надо включить отправку данных для чека.
[Помощь Кассы: отправка чеков по 54-ФЗ](https://yandex.ru/support/checkout/payments/tax-sync.html)

### Требования к Omnipay:
* версия 2.x

### Установка модуля
Установка модуля производится через [Composer](https://getcomposer.org/) запуском команды:
```
composer require yandexmoney/omnipay
```
или включением в файл `composer.json` пакета `yandexmoney/omnipay` с выполнением команды:
```
composer update
```
### Использование
Использование платежного модуля можно разделить на несколько последовательных шагов:

1. Автозагрузка необходимых классов
 ```
require_once (__DIR__.'/vendor/autoload.php');
 ```

2. Использование класса Omnipay/Omnipay
 ```
use Omnipay\Omnipay;
 ```
3. Настройкой модуля для приема платежей:
 * на кошелек Яндекс.Деньги:
 ```
$gateway = Omnipay::create('\yandexmoney\YandexMoney\GatewayIndividual');
$gateway->setAccount([номер_кошелька]);
$gateway->setLabel([номер_заказа]);
$gateway->setPassword([секретное_слово]);
$gateway->setOrderId([номер_заказа]);
$gateway->setMethod([тип_оплаты_PC_или_AC]);
$gateway->setReturnUrl([адрес_страницы_успеха]);
$gateway->setCancelUrl([адрес_страницы_отказа]);
 ```
 * через сервис Яндекс.Касса:
 ```
$gateway = Omnipay::create('\yandexmoney\YandexMoney\Gateway');
$gateway->setShopId([идентификатор_магазина]);
$gateway->setScid([номер_витрины_магазина]);
$gateway->setCustomerNumber([идентификатор_плательщика]);
$gateway->setOrderNumber([номер_заказа]);
$gateway->setOrderId([номер_заказа]);
$gateway->setMethod([тип_оплаты]);
$gateway->setReturnUrl([адрес_страницы_успеха]);
$gateway->setCancelUrl([адрес_страницы_отказа]);
 ```
5. Отправкой запроса
 * на кошелек Яндекс.Деньги:
 ```
$response = $gateway->purchase(['amount' => '1.00', 'currency' => 'RUB', 'testMode' => true, 'FormComment'=>'test'])->send();
 ```
 * через сервис Яндекс.Касса:
 ```
$response = $gateway->purchase(['amount' => '1.00', 'currency' => 'RUB', 'testMode' => true])->send();
 ```
6. Обработкой ответа 
```
if ($response->isSuccessful()) {
    print_r($response);
} elseif ($response->isRedirect()) {
    $response->redirect();
} else {
    echo $response->getMessage();
}
```
### Лицензионный договор.
Любое использование Вами программы означает полное и безоговорочное принятие Вами условий лицензионного договора, размещенного по адресу https://money.yandex.ru/doc.xml?id=527132 (далее – «Лицензионный договор»). 
Если Вы не принимаете условия Лицензионного договора в полном объёме, Вы не имеете права использовать программу в каких-либо целях.


### Контакты
Если у вас есть вопросы или идеи для модуля, напишите нам: cms@yamoney.ru

В письме укажите:
* версию платформы,
* версию модуля (можно посмотреть на странице настроек),
* идею или проблему,
* снимок экрана, о котором говорите.

<?php

class User
{
    // IDE warnings suppression
}

interface NotificatorContract
{
    public function notify(User $user, string $text): void;
}

class NotificationService
{
    protected EmailNotificator $emailNotificator;
    protected SmsNotificator $smsNotificator;
    protected WebPushNotificator $webPushNotificator;

    /* Если бы можно было менять клиентский код либо использовался бы Laravel'евский IoC то можно было бы так
    public function __construct(EmailNotificator $emailNotificator, SmsNotificator $smsNotificator, WebPushNotificator $webPushNotificator)
    {
        $this->emailNotificator = $emailNotificator;
        $this->smsNotificator = $smsNotificator;
        $this->webPushNotificator = $webPushNotificator;
    }
    */

    // Вариант IoC без Laravel и реестра:
    public function setEmailNotificator(EmailNotificator $emailNotificator): void
    {
        $this->emailNotificator = $emailNotificator;
    }

    public function setSmsNotificator(SmsNotificator $setSmsNotificator): void
    {
        $this->smsNotificator = $setSmsNotificator;
    }

    public function setWebPushNotificator(WebPushNotificator $webPushNotificator): void
    {
        $this->webPushNotificator = $webPushNotificator;
    }

    public function notify(User $user, string $text): void
    {
        $this->emailNotificator->notify($user, $text);
        $this->smsNotificator->notify($user, $text);
        $this->webPushNotificator->notify($user, $text);
    }
}

// В случае указания конкретной (см. ниже) реализации - добавить abstract
class EmailNotificator implements NotificatorContract
{
    /*
    По аналогии с NotificationService можно сделать указание конкретных сервисов нотификаторов (ex.: Mailgun)
    В Laravel, например, так:

    protected EmailNotificator $notificator;
    public function __construct(EmailNotificator $notificator) {
        $this->notificator = $notificator;
    }

    Без Laravel наиболее быстрый путь:

    public function setNotificator(EmailNotificator $notificator) {
        $this->notificator = $notificator;
    }

    Реализации сделать отдельным интерфейсом либо наследовать от EmailNotifier
    */

    public function notify(User $user, string $text): void
    {
        // sendEmail($user->email, $text);
    }
}

class SmsNotificator implements NotificatorContract
{
    public function notify(User $user, string $text): void
    {
        // sendSms($user->phone, $text);
    }
}

class WebPushNotificator implements NotificatorContract
{
    public function notify(User $user, string $text): void
    {
        // sendPush($user->pusher_id, $text);
    }
}

// Как понял из задания, клиентский код менять нельзя
$service = new NotificationService();

// Клиентский код с доступом к готовому к работе объекту сервиса рассылки
$text = 'Какой-то текст';
$users = [new User]; // IDE warnings suppressing
foreach ($users as $user) {
    $service->notify($user, $text);
}

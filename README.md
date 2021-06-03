# Какие принципы SOLID нарушены в проектировании сервиса отправки уведомлений
SOLID описывает далеко не все кейсы плохого кода, не все недочеты получилось подогнать под какой-то один принцип.
Single responsibility - смотря насколько сильно смотреть, можно по-хорошему можно прикопаться и к тому, что NotificationService оперирует phone и email пользователя
Open/closed - нарушается поставщиками уведомлений (sms, email)
Liskov substitution - N/A, нет наследников
Interface segregation - N/A (считается ли отсутствие интерфейсов нарушением конкретно SOLID?)
Dependency Inversion - более высокоуровневый код (сервис) зависит от низкоуровнего (поставщики)

# Какие паттерны проектирования можно использовать, чтобы сделать сервис более гибким и способным к легкому расширению способов рассылки
Реестр, DI, возможно для некоторых кейсов Стратегия

# Какие еще проблемы есть в этом коде
Нет возможности подменять конкретную реализацию (например, сервис отправки email), нет возможности отправлять уведомления не во все каналы, нет возможности бродкастить сразу нескольким пользователям, потенциальные касты типов и ошибки из-за отсутсвия явного типизирования (email, text, phone), нет единообразного интерфейса для поставщиков -> сложности при добавлении нового

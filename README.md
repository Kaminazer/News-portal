# News Portal

## Опис

Додаток дозволяє вести новинний портал з можливістю додавання на редагування новин на необхідну тематику.

## Вимоги

Перед початком роботи з додатком, переконайтесь, що ваш сервер відповідає наступним вимогам:

- PHP 7.4 або новіше
- MySQL або інший сумісний СУБД
- Composer
- npm
- nodeJS

## Встановлення

1. Склонуйте репозиторій цього додатку на свій локальний комп'ютер.
```bash
git clone git@github.com:Kaminazer/News-portal.git
```
або
```bash
git clone https://github.com/Kaminazer/News-portal.git
```
2. Перейдіть до каталогу проекту.

3. Встановіть залежності за допомогою Composer.

```bash
composer install
```
4. Встановіть залежності за допомогою npm.

```bash
npm install
```
5. Створіть копію файлу .env.example і перейменуйте її у .env. Вкажіть налаштування бази даних та інші необхідні параметри.

```bash
cp .env.example .env
```
6. Згенеруйте ключ додатку.

```bash
php artisan key:generate
```
7. Запустіть міграції для створення таблиць у базі даних.

```bash
php artisan migrate
```
8. Виконайте збирання та компіляцію ресурсів проекту
```bash
npm run dev
```

9. Запустіть локальний сервер
```bash
php artisan serve
```
10. Створіть символічне посилання на Storage, для коректного відображення картинок
```bash
php artisan Storage:link
```
Додаток тепер доступний за адресою http://localhost:8000.
## Використання

Після встановлення і запуску додатку ви можете відкрити його у вашому браузері та почати працювати з ним. Спочатку необхідно створити акаунт та увійти в систему. Після цього ви зможете додавати та редагувати новини на власний розсуд.
## Внесення правок

Якщо ви знайшли помилки або маєте ідеї щодо покращення цього додатку, будь ласка, створіть pull request або відкрийте новий issue у репозиторії.
## Автор

    Ваше ім'я  Король Назарій
    Електронна пошта: nazarkorol3684@gmail.com
    GitHub: @Kaminazer

## Ліцензія

Цей проект розповсюджується під ліцензією [MIT license](https://opensource.org/licenses/MIT).

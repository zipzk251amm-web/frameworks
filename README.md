Цей репозиторій містить виконане практичне завдання зі створення REST API на двох популярних PHP фреймворках — Laravel та Symfony.



\*Завдання

Реалізувати CRUD (Create, Read, Update, Delete) операції для сутності "Hospital" (Лікарня) з використанням:



Laravel (Eloquent ORM, SQLite)



Symfony (Doctrine ORM, SQLite)



\*Структура репозиторію

text

frameworks/

├── laravel/                    # Laravel проект

│   ├── app/                    # Моделі, контролери

│   ├── database/               # Міграції, база даних

│   ├── routes/                 # Маршрути (api.php)

│   └── ...

├── symfony/                    # Symfony проект

│   ├── src/                    # Сутності, контролери

│   ├── migrations/             # Міграції Doctrine

│   └── ...

├── Laravel-Hospital-API.json   # Postman колекція для Laravel

└── Symfony-Hospital-API.json   # Postman колекція для Symfony



\*API Endpoints

Laravel (порт 8000)

Метод	URL	Опис

GET	/api/hospitals	Отримати список всіх лікарень

GET	/api/hospitals/{id}	Отримати одну лікарню за ID

POST	/api/hospitals	Створити нову лікарню

PATCH	/api/hospitals/{id}	Частково оновити лікарню

DELETE	/api/hospitals/{id}	Видалити лікарню

Symfony (порт 8001)

Метод	URL	Опис

GET	/hospitals	Отримати список всіх лікарень

GET	/hospitals/{id}	Отримати одну лікарню за ID

POST	/hospitals	Створити нову лікарню

PATCH	/hospitals/{id}	Частково оновити лікарню

DELETE	/hospitals/{id}	Видалити лікарню



\*Приклад запиту POST

json

{

&#x20;   "name": "Міська лікарня №1",

&#x20;   "address": "вул. Лікарняна 5, Житомир",

&#x20;   "phone": "+380441234567",

&#x20;   "beds": 150,

&#x20;   "rating": 4.7

}



\*Як запустити

Передумови

PHP 8.2+



Composer



SQLite



1\. Laravel

bash

cd laravel

composer install

cp .env.example .env  # Налаштуйте DB\_CONNECTION=sqlite

php artisan migrate

php artisan serve

API доступне за адресою: http://localhost:8000/api/hospitals



2\. Symfony

bash

cd symfony

composer install

cp .env.example .env  # Налаштуйте DATABASE\_URL

php bin/console doctrine:migrations:migrate

php -S localhost:8001 -t public

API доступне за адресою: http://localhost:8001/hospitals



\*Тестування

Для тестування API використовуйте імпортовані Postman колекції:



Відкрийте Postman



Натисніть "Import"



Виберіть файли:



Laravel-Hospital-API.json



Symfony-Hospital-API.json



\*Автор

Андросович Максим

Група: ЗІПЗк-25-1

Варіант: 57 (Hospital)





\*Примітки

Для обох проектів використовується база даних SQLite.



Усі ендпоїнти повертають відповіді у форматі JSON.



Міграції створюють таблицю hospitals з полями: id, name, address, phone, beds, rating, timestamps.


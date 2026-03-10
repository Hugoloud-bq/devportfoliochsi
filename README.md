# 🚀 DevPortfolio

**Личный дневник практики и портфолио разработчика**

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![License](https://img.shields.io/badge/license-MIT-green)
![GitHub last commit](https://img.shields.io/github/last-commit/Chulyakov/DevPortfolio)

---

## 📋 О проекте

**DevPortfolio** — веб приложение для студентов, которое позволяет следить за своими работами, проектами, отчётами, дневниками и так далее (личный прогресс). Система автоматизирует отслеживание сданных работ, хранения файлов и отчетов. Каждый юзер имеет личный кабинет с изолированными данными.

---

## ✨ Функциональные возможности

### 👤 **Авторизация и профиль**
- Регистрация и вход по email
- Личный профиль с аватаром, стеком технологий, ссылками на GitHub и Telegram
- Восстановление пароля

### 📁 **Управление проектами (CRUD)**
- Добавление, просмотр, редактирование и удаление работ
- Категории: Лабораторная, Курсовая, Практика, Диплом
- Статусы выполнения: ТЗ, Отчёт, Дневник

### 📎 **Работа с файлами**
- Загрузка основного файла (отчёт, документация)
- Галерея скриншотов (несколько изображений к работе)
- Поддержка PDF, DOC, DOCX, JPG, PNG (до 2 МБ)

### 🔍 **Фильтры и поиск**
- Поиск по названию
- Фильтр по статусам (ТЗ, отчёт, дневник, GitHub, файлы)
- Сортировка по дате, названию, предмету

### 📊 **Статистика и графики**
- Общая статистика на главной
- Прогресс-бары по 5 параметрам
- Графики динамики и выполнения (Chart.js)

### 📤 **Экспорт данных**
- Выгрузка отчёта в Excel со всеми работами пользователя

### 🌙 **Тёмная тема**
- Переключатель темы с сохранением выбора в localStorage

### 🔔 **Уведомления**
- Всплывающие сообщения при добавлении, редактировании, удалении

---

## 🛠 Технологический стек

| Компонент | Технология |
|-----------|------------|
| **Backend** | PHP 8.2, Laravel 12 |
| **Frontend** | Blade, Bootstrap 5, Chart.js |
| **База данных** | SQLite / MySQL |
| **Аутентификация** | Laravel Breeze |
| **Экспорт** | Laravel Excel (Maatwebsite) |
| **Иконки** | FontAwesome 6 |

---

## 🚀 Установка и запуск

### 1. Клонирование репозитория
```bash
git clone https://github.com/Chulyakov/DevPortfolio.git
cd DevPortfolio
```
### 2. Установка зависимостей
```bash
composer install
npm install
```
### 3. Настройка окружения
```bash
cp .env.example .env
php artisan key:generate
```
### 4. Настройка базы данных
```В файле .env укажите:
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
Затем создайте файл базы и выполните миграции:
```
```bash
touch database/database.sqlite
php artisan migrate
```
### 5. Создание символической ссылки для файлов
```bash
php artisan storage:link
```
### 6. Запуск сервера разработки
```bash
npm run dev
php artisan serve
```
### Откройте браузер по адресу: http://localhost:8000

## 🗂 Структура базы данных

### Таблица `users`
Стандартные поля Laravel

### Таблица `projects`
| Поле | Тип | Описание |
|------|-----|----------|
| `id` | primary | Первичный ключ |
| `user_id` | foreign | Владелец проекта |
| `title` | string | Название |
| `subject` | string | Предмет |
| `type` | string | Тип работы |
| `description` | text | Описание |
| `github_link` | string | Ссылка на репозиторий |
| `file_path` | string | Путь к файлу |
| `tz_status` | boolean | Статус ТЗ |
| `report_status` | boolean | Статус отчёта |
| `diary_status` | boolean | Статус дневника |
| `start_date` | date | Дата начала |
| `end_date` | date | Дата сдачи |
| `hours_spent` | integer | Затраченное время |
| `share_token` | string | Токен для публичного доступа |
| `timestamps` | - | created_at, updated_at |

### Таблица `screenshots`
| Поле | Тип | Описание |
|------|-----|----------|
| `id` | primary | Первичный ключ |
| `project_id` | foreign | Связь с проектом |
| `path` | string | Путь к скриншоту |
| `timestamps` | - | created_at, updated_at |

### Таблица `abouts`
| Поле | Тип | Описание |
|------|-----|----------|
| `id` | primary | Первичный ключ |
| `user_id` | foreign | Владелец профиля |
| `name` | string | Имя |
| `title` | string | Должность |
| `bio` | text | О себе |
| `email` | string | Email |
| `github` | string | GitHub |
| `telegram` | string | Telegram |
| `avatar` | string | Аватар |
| `skills` | json | Навыки (JSON) |


| `university` | string | Учебное заведение |
| `specialty` | string | Специальность |
| `course` | integer | Курс |

## 📸 Скриншоты приложения

| **Главная до входа** | **Главная после входа** |
|:---------------------:|:------------------------:|
| ![Главная-Вход](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%93%D0%BB%D0%B0%D0%B2%D0%BD%D0%B0%D1%8F-%D0%92%D1%85%D0%BE%D0%B4.png) | ![Главная после входа](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%93%D0%BB%D0%B0%D0%B2%D0%BD%D0%B0%D1%8F%20%D0%BF%D0%BE%D1%81%D0%BB%D0%B5%20%D0%B2%D1%85%D0%BE%D0%B4%D0%B0.png) |

| **Вход** | **Регистрация** |
|:--------:|:---------------:|
| ![Вход](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%92%D1%85%D0%BE%D0%B4.png) | ![Регистрация](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%A0%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%86%D0%B8%D1%8F.png) |

| **Мои работы** | **Добавить работу** |
|:--------------:|:-------------------:|
| ![Вкладка Мои работы](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%92%D0%BA%D0%BB%D0%B0%D0%B4%D0%BA%D0%B0%20%D0%9C%D0%BE%D0%B8%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%8B.png) | ![вкладка добавить работу](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%B2%D0%BA%D0%BB%D0%B0%D0%B4%D0%BA%D0%B0%20%D0%B4%D0%BE%D0%B1%D0%B0%D0%B2%D0%B8%D1%82%D1%8C%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%83.png) |

| **Редактирование работы** | **Просмотр работы** |
|:-------------------------:|:-------------------:|
| ![Редактирование работы](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%A0%D0%B5%D0%B4%D0%B0%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%8B.png) | ![просмотр работы](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%BF%D1%80%D0%BE%D1%81%D0%BC%D0%BE%D1%82%D1%80%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%8B.png) |

| **Выбор скриншота** | **Генерация описания через ИИ** |
|:-------------------:|:-------------------------------:|
| ![выбор скриншота](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%B2%D1%8B%D0%B1%D0%BE%D1%80%20%D1%81%D0%BA%D1%80%D0%B8%D0%BD%D1%88%D0%BE%D1%82%D0%B0.png) | ![генерация описания через ии](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%B3%D0%B5%D0%BD%D0%B5%D1%80%D0%B0%D1%86%D0%B8%D1%8F%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D1%8F%20%D1%87%D0%B5%D1%80%D0%B5%D0%B7%20%D0%B8%D0%B8.png) |

| **Статистика на главной** | **Вкладка Статистика (часть 1)** |
|:-------------------------:|:--------------------------------:|
| ![Статистика на главной](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%A1%D1%82%D0%B0%D1%82%D0%B8%D1%81%D1%82%D0%B8%D0%BA%D0%B0%20%D0%BD%D0%B0%20%D0%B3%D0%BB%D0%B0%D0%B2%D0%BD%D0%BE%D0%B9.png) | ![вкладка статистика 1](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%B2%D0%BA%D0%BB%D0%B0%D0%B4%D0%BA%D0%B0%20%D1%81%D1%82%D0%B0%D1%82%D0%B8%D1%81%D1%82%D0%B8%D0%BA%D0%B0%201.png) |

| **Вкладка Статистика (часть 2)** | **Работа темной темы** |
|:-------------------------------:|:----------------------:|
| ![вкладка статистика 2](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%B2%D0%BA%D0%BB%D0%B0%D0%B4%D0%BA%D0%B0%20%D1%81%D1%82%D0%B0%D1%82%D0%B8%D1%81%D1%82%D0%B8%D0%BA%D0%B0%202.png) | ![работа темной темы](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0%20%D1%82%D0%B5%D0%BC%D0%BD%D0%BE%D0%B9%20%D1%82%D0%B5%D0%BC%D1%8B.png) |

| **Вкладка "О себе"** | **Редактирование "О себе"** |
|:--------------------:|:---------------------------:|
| ![вкладка о себе](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%B2%D0%BA%D0%BB%D0%B0%D0%B4%D0%BA%D0%B0%20%D0%BE%20%D1%81%D0%B5%D0%B1%D0%B5.png) | ![редактирование о себе](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D1%80%D0%B5%D0%B4%D0%B0%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5%20%D0%BE%20%D1%81%D0%B5%D0%B1%D0%B5.png) |

| **Формат печати / PDF** | **Печать отчета по работам** |
|:-----------------------:|:----------------------------:|
| ![формат печати и сохранения в pdf](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D1%84%D0%BE%D1%80%D0%BC%D0%B0%D1%82%20%D0%BF%D0%B5%D1%87%D0%B0%D1%82%D0%B8%20%D0%B8%20%D1%81%D0%BE%D1%85%D1%80%D0%B0%D0%BD%D0%B5%D0%BD%D0%B8%D1%8F%20%D0%B2%20pdf.png) | ![печать отчёта по работам](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D0%BF%D0%B5%D1%87%D0%B0%D1%82%D1%8C%20%D0%BE%D1%82%D1%87%D1%91%D1%82%D0%B0%20%D0%BF%D0%BE%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0%D0%BC.png) |

| **Экспорт в Excel** | **Ссылка "Поделиться"** | **Удаление работы** |
|:-------------------:|:-----------------------:|:-------------------:|
| ![экспорт в exel](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D1%8D%D0%BA%D1%81%D0%BF%D0%BE%D1%80%D1%82%20%D0%B2%20exel.png) | ![ссылка поделиться](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D1%81%D1%81%D1%8B%D0%BB%D0%BA%D0%B0%20%D0%BF%D0%BE%D0%B4%D0%B5%D0%BB%D0%B8%D1%82%D1%8C%D1%81%D1%8F.png) | ![удаление работы](https://raw.githubusercontent.com/Hugoloud-bq/devportfoliochsi/main/screenshots/%D1%83%D0%B4%D0%B0%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%8B.png) |

## 🎯 Планы по развитию

- [ ] 💬 Комментарии преподавателя к работам
- [ ] ⏰ Уведомления о приближении дедлайнов
- [ ] 🔌 REST API для мобильного приложения
- [ ] 📥 Импорт работ из Excel
- [ ] 🌍 Деплой на хостинг
- [ ] 🤖 ИИ-генератор описания работ (Gemini API)

---

## 👨‍💻 Автор

**Чуляков Семён Игоревич**  
Студент, разработчик  
📧 wrstmmry@yandex.ru
🐙 [GitHub](https://github.com/Hugoloud-bq)  
📱 [Telegram](https://t.me/wrstmmry)

---


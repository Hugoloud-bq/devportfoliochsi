# 🚀 DevPortfolio

**Личный дневник практики и портфолио разработчика**

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![License](https://img.shields.io/badge/license-MIT-green)
![GitHub last commit](https://img.shields.io/github/last-commit/Chulyakov/DevPortfolio)

---

## 📋 О проекте

**DevPortfolio** — это веб-приложение для студентов IT-специальностей, позволяющее вести учёт лабораторных работ, курсовых проектов и отчётов по практике. Система автоматизирует процесс отслеживания сданных работ, хранения файлов и генерации отчётности. Каждый пользователь имеет личный кабинет с изолированными данными.

Проект разработан в рамках учебной практики по дисциплине **"Инструментальные средства разработки программного обеспечения"**.

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

## 📄 Лицензия

Проект распространяется под лицензией **MIT**. Подробнее — в файле [LICENSE](LICENSE).

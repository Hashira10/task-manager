
# Task Manager

## Развертывание

### Локальная установка и запуск

1. **Клонируйте репозиторий**:
    ```bash
    git clone [https://github.com/your-repo/task-manager.git](https://github.com/Hashira10/task-manager.git)
    cd task-manager
    ```

2. **Установите зависимости**:
    ```bash
    composer install
    npm install
    ```

3. **Настройте окружение**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Отредактируйте файл `.env` и укажите параметры подключения к базе данных.

5. **Выполните миграции**:
    ```bash
    php artisan migrate
    ```

6. **Запустите сервер и фронтенд**:
    ```bash
    php artisan serve
    npm run dev
    ```

7. Откройте браузер и перейдите по адресу:  
    [http://localhost:8000](http://localhost:8000)

---

### Развертывание с использованием Docker

Для запуска в Docker:
Используйте DB_HOST=db в .env, так как база данных запускается в контейнере и доступна по имени сервиса Docker Compose

1. **Клонируйте репозиторий**:
    ```bash
    git clone https://github.com/your-repo/task-manager.git
    cd task-manager
    ```

2. **Соберите и запустите контейнеры**:
    ```bash
    docker-compose up --build
    ```
3. **Установка npm-зависимостей в контейнере фронтенда (node)**:
    ```bash
    docker-compose exec node npm install
    ```

4. **Сборка фронтенда**:
    ```bash
    docker-compose exec node npm run build
    ```

5. **Выполнение миграций базы данных**:
    ```bash
    docker-compose exec app php artisan migrate
    ```

6. Откройте браузер и перейдите по адресу:  
    [http://localhost:8000](http://localhost:8000)


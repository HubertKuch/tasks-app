# tasks-app

## 🚀 Run Commands

```shell
git clone git@github.com:HubertKuch/tasks-app.git 
cd tasks-app
mv .env.example .env 
composer install 
npm install 
sudo docker compose -f dev.compose.yaml up
```
If `container todo-db is unhealthy` rerun `sudo docker compose -f dev.compose.yaml up`!

Application should be available on `http://127.0.0.1:8000`

## 📁 Project Structure

```
.
├── app
│   ├── Console
│   │   └── Commands
│   │       └── SendLateTasksEmails.php
│   ├── Enums
│   │   ├── TaskPriority.php
│   │   └── TaskStatus.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Controller.php
│   │   │   ├── LoginController.php
│   │   │   └── RegisterController.php
│   │   └── Middleware
│   │       ├── AuthMiddleware.php
│   │       └── OnlyGuests.php
│   ├── Livewire
│   │   ├── Forms
│   │   │   └── TaskEditForm.php
│   │   ├── LoginView.php
│   │   ├── MainView.php
│   │   ├── RegisterSuccessView.php
│   │   ├── RegisterView.php
│   │   ├── SharedTasksView.php
│   │   └── SideBar.php
│   ├── Mail
│   │   └── TasksReminderMail.php
│   ├── Models
│   │   ├── Task.php
│   │   ├── TaskShare.php
│   │   └── User.php
│   └── Providers
│       ├── AppServiceProvider.php
│       └── VoltServiceProvider.php
├── artisan
├── bootstrap
│   ├── app.php
│   └── providers.php
├── bun.lock
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   ├── session.php
│   ├── snapshot.php
│   └── user-preferences.php
├── database
│   ├── factories
│   │   ├── TaskFactory.php
│   │   ├── TaskShareFactory.php
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 2025_08_12_105826_create_sessions_table.php
│   │   ├── 2025_08_12_105939_create_users_table.php
│   │   ├── 2025_08_12_115803_create_tasks_table.php
│   │   ├── 2025_08_12_193817_create_jobs_table.php
│   │   ├── 2025_08_13_070353_add_preferences_to_table.php
│   │   ├── 2025_08_13_071728_create_task_shares_table.php
│   │   └── 2025_08_13_195116_snapshots_migration.php
│   └── seeders
│       ├── DatabaseSeeder.php
│       ├── TaskSeeder.php
│       └── UserSeeder.php
├── dev.compose.yaml
├── docker
│   ├── dev
│   │   ├── Dockerfile
│   │   ├── entrypoint.sh
│   │   └── vite-entry.sh
│   ├── nginx
│   │   ├── Dockerfile
│   │   └── nginx.conf
│   └── php-fpm
│       ├── Dockerfile
│       └── entrypoint.sh
├── package.json
├── phpunit.xml
├── prod.compose.yaml
├── public
│   ├── .vite
│   │   └── deps
│   │       ├── _metadata.json
│   │       └── package.json
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── resources
│   ├── css
│   │   ├── app.css
│   │   └── specification.css
│   ├── js
│   │   ├── app.js
│   │   ├── bootstrap.js
│   │   └── main.js
│   └── views
│       ├── components
│       │   └── layouts
│       │       └── app.blade.php
│       ├── livewire
│       │   ├── shared-tasks-view.blade.php
│       │   ├── side-bar.blade.php
│       │   ├── singletask.blade.php
│       │   ├── task-dropdown-options.blade.php
│       │   ├── task-edit-dialog.blade.php
│       │   ├── task-history-modal.blade.php
│       │   ├── task-share-modal.blade.php
│       │   └── topbar.blade.php
│       ├── mail
│       │   └── tasks-reminder-mail.blade.php
│       └── views
│           ├── errors
│           │   └── 404.blade.php
│           ├── login-view.blade.php
│           ├── main-view.blade.php
│           ├── register-success-view.blade.php
│           └── register-view.blade.php
├── routes
│   ├── console.php
│   └── web.php
├── tailwind.config.js
├── tests
│   ├── Console
│   │   └── Commands
│   │       └── SendLateTasksEmailsTest.php
│   └── TestCase.php
└── vite.config.js
```


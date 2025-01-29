<h3>Installation instructions</h2>

<b>1. Clone the Repository</b>

<i>git clone https://github.com/shar0nnn/test-task-todo-list.git

cd test-task-todo-list</i>

<b>2. Copy the Environment File</b>

<i>cp .env.example .env</i>

Then, update the .env file with your configuration database settings.

<b>3. Install Composer Dependencies</b>

<i>docker run --rm -u "\$(id -u):\$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php84-composer:latest composer install --ignore-platform-reqs</i>

<b>4. Start Laravel Sail</b>

<i>./vendor/bin/sail up -d</i>

<b>5. Generate Application Key</b>

<i>sail artisan key:generate</i>

<b>6. Install NPM Dependencies</b>

<i>./vendor/bin/sail npm install</i>

<b>then start Vite in development mode</b>

<i>./vendor/bin/sail npm run dev</i>

<b>or, for production build run</b>

<i>./vendor/bin/sail npm run build</i>

<b>7. Run Migrations</b>

<i>sail artisan migrate --seed</i>

<b>This command also creates 2 test users and 3 test tasks:</b>

user 1: 

<i>email => bob@gmail.com,
password => bob123</i>

user 2:

<i>email => john@gmail.com,
password => john123</i>

<b>8. The list of endpoints for testing functionality</b>

<i>http://localhost - main URL to display tasks table

http://localhost/docs - API documentation

http://localhost/api/register - (POST) URL for user registration

http://localhost/api/login - (POST) URL for user login

http://localhost/api/tasks - (GET) URL to get tasks and (POST) URL to create a task

http://localhost/api/tasks/{task} - (PATCH) URL to edit a task

http://localhost/api/tasks/{task} - (DELETE) URL to delete a task</i>

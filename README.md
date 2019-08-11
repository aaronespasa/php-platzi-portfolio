# PHP Portfolio
A portfolio which works with PHP. It allows you to add new jobs and projects since the same page and also start session with your own account.

### How to use it?
1. You need to **run an Apache server and a MySQL database**: For this, you might install XAMPP, LAMP or WAMP (Depending on your OS)<br /><br />
2. Once you have cloned the repository, you have to **type on the terminal** (in the same folder of the repository):<br />
`php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php composer.phar install`<br /><br />
3. Go to `localhost:8080/phpmyadmin` and create a new database (ej. `php-portfolio`). Then create 3 tables: `jobs`, `projects` and `users`:<br /><br />
The `jobs` section must contain 8 columns -> id(int, primary, A.I.), title(text), description(text), visible(boolean, default=0), months(int, default=0), created_at(datetime), updated_at(datetime), logo(text, Null=Yes, default=Null)<br /><br />
The `projects` section must contain 7 columns -> id(int, primary, A.I.), title(text), description(text), visible(boolean, default=0), months(int, default=0), created_at(datetime), updated_at(datetime)<br /><br />
The `users` section must contain 7 columns -> id(int, primary, A.I.), email(text), password(text), created_at(datetime), updated_at(datetime)<br /><br />

4. **Rename** the **".env.sample"** file to **".env"** and **change the parameters that it receives** to connect to the database. For example, change `DB_HOST = YOUR_HOST` to `DB_HOST = localhost`, `DB_NAME = YOUR_DATABASE_NAME` to `DB_HOST = php-portfolio`, `DB_USER = YOUR_USER` to `DB_USER = root` and `DB_PASS = YOUR_PASS` to `DB_PASS = `<br /><br />
5. Type on the URL of your browser (Make sure that the apache server is listening on port 8080): **`localhost:8080/php-platzi-portfolio/public/`**

And you will have the page working!

### How to be an admin to add elements and create users?
1. Go to `localhost:8080/phpmyadmin` > `php-portfolio` (Your DB_NAME) > `users`

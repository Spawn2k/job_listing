- install php on wsl2 ubuntu

```bash
sudo apt-get install php-common php-mysql php-cli
```

- check php if php installed

```bash
php -v
```

- remove php
```bash
sudo apt-get --purge remove php-common
```

- install composer
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

- set composer global  
```bash
sudo mv composer.phar /usr/local/bin/composer
```

- check composer 
```bash
composer -v
```

- install Node Version Manager (NVM)
```bash
wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/v0.37.0/install.sh | bash
```

- check nvm (restart your terminal first)
```bash
nvm -v
```

- install node with nvm
```bash
nvm install node
```

- install mysql 
```bash
sudo apt install mysql-server
```

- remove mysql
```bash
sudo apt-get remove --purge '*mysql*'
```

- install secure package mysql
```bash
sudo mysql_secure_installation
```

- start mysql Server
```bash
sudo service mysql start
```

- run security script
```bash
sudo mysql_secure_installation
```

- stopp mysql Server
```bash
sudo service mysql stopp
```

- login mysql
```bash
sudo mysql
```

- create user for mysql login
- username: root
- password: root
```sql
ALTER
USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
```

- create db
```sql
CREATE DATABASE dev;
```

- install git
```bash
sudo apt-get install git-all
```

- check git
```bash
git --version
```

- php pdo
```php
<?php
$dns = 'mysql:host=localhost;port=3306;dbname=dev';
$username = 'root';
$pw = 'root';
$options = [
     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
   ];

$db = new Pdo($dns, $username, $password, $options);
```



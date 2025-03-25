Laravel Project Deployment Guide
1. Prepare Your Live Server
First, ensure your live server meets the following requirements:
•	PHP 8.0 or higher with the following extensions: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON
•	Nginx/Apache web server configured for optimal performance
•	MySQL/MariaDB (version 5.7+ recommended)
•	Composer installed (latest version preferred)
•	SSH access properly set up with secure keys
2. Configure Your Laravel Project
Next, we copy  the .env.example file to .env, using command
 “cp .env.example .env”
Also update database credentials and other configurations in .env. 
 DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital
DB_USERNAME=root
DB_PASSWORD=

3. Upload Your Project
We use FTP or SSH to upload your Laravel project files to server. We use an FTP client like FileZilla or WinSCP and upload all files to the /var/www/hospital directory.
Or we can use Git to clone the repository with this command
” git clone your-repo-url.git /var/www/your-project”

4. Install Dependencies
Run the following command to install project dependencies without development packages and optimize the autoloader: “composer install --no-dev --optimize-autoloader”

5. Set Up File Permission
Set the correct permissions for the project files:
“sudo chown -R www-data:www-data /var/www/hospital
sudo chmod -R 755 /var/www/hoapital
sudo chmod -R 775 storage bootstrap/cache”

6. Generate Application Key
To run the web, we must generate the application key using: “php artisan key:generate”

7. Run Database Migrations and Seeding
Then we execute database migrations and seeders to populate the database:
“php artisan migrate –force”
“php artisan db:seed –force”
8. Configure Web Server
For Nginx Server setup , we use  this code:
“server {
    listen 80;
    server_name your-domain.com;
    root /var/www/your-project/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}”

9. Set Up Cron Jobs(if applicable)
Add the following cron job to run scheduled tasks:
“* * * * * php /var/www/your-project/artisan schedule:run >> /dev/null 2>&1”
10. Configure Caching and Optimization
Optimize the application by caching configuration, routes, and views:
“php artisan config:cache”
“php artisan route:cache”
11.Set Up SSL
Install Let's Encrypt SSL certificate for secure connections:
“sudo apt install certbot python3-certbot-nginx”
“sudo certbot --nginx -d your-domain.com”
12. Restart Services and Test
Now, we restart the necessary services and test the deployment:
“sudo systemctl restart nginx”
“sudo systemctl restart php8.0-fpm”
*Testing Checklist:
•	Verify that all core functionalities are working correctly.
•	Check logs for any potential issues:
Laravel logs: storage/logs/laravel.log
Nginx logs: /var/log/nginx/error.log



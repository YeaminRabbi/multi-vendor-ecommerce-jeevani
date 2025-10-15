### Local Setup

1. Install PHP dependencies:
   ```
   composer install
   ```

2. Install and build frontend assets:
   ```
   npm install
   npm run dev
   ```

3. Set up environment:
   ```
   cp .env.example .env
   ```

4. Configure your `.env`:
    - Set up database connection

5. import database.sql(databases folder)


7. Serve the application:
   ```
   php artisan serve
   ```
   

## Super Admin Login Credintials
<p><b>Url:</b> project_ur//admin/login</p>
<p><b>Email:</b> admin@admin.com</p>
<p><b>Password: </b>12345678</p>


## Some Global Property for blade file

$Media - For Load media files such as images, files
 ```
 $Media($filename)
 ```

## Resources
- [Laravel Documentation](https://laravel.com/docs)
- [FilamentPHP Documentation](https://filamentphp.com/docs)
- [Filament Ecommerce Documentation](https://filamentphp.com/plugins/3x1io-tomato-ecommerce)

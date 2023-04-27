1. Install laravel/ui for auth
- composer require laravel/ui

2. Create blog module
- php artisan make:model Blog -mcr
- update create_blogs_table migration
- php artisan migrate
- complete blog module

3. Create Auth API
- php artisan make:controller Api/AuthController --api
- php artisan make:resource UserResource
- php artisan make:resource UserCollection
- Update Unauthenticated error for API: App\Exceptions\Handler

4. Create Blog API
- php artisan make:controller Api/BlogController --api
- php artisan make:resource BlogResource
- php artisan make:resource BlogCollection

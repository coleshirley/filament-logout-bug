## A demo of odd functionality when logging out of a Panel

### Steps to Reproduce

1. run migrations `php artisan migrate`
2. make filament user `php artisan make:filament-user`
3. serve application `php artisan serve`
4. log into application at http://localhost:8000/admin/login
5. navigate to app panel at http://localhost:8000/app
6. log out of application
7. experience error due to null user from `app/Filament/App/Pages/Dashboard.php`

### Explanation

When you log out from a panel in filament the default `LogoutResponse` class checks if that panel has a login page. If it does, then the user is redirected to that page. If it does not then the user is supposed to be redirected to the first navigation item available registered for the current panel.

In order for this to happen, filament has to register all of the navigation items for the current panel in order to determine which one is first. As part of registering all of the navigation items for the panel the `shouldRegisterNavigation` and `canAccess` methods are called on each page and resource.

This process occurs after the user has already been logged out of the application so if you are attempting to access the currently authenticated user in either of the above methods (i.e. using `auth()->user()`) it will return null.

The solution to this problem is to always check if there is a currently authenticated user or not in either of the above methods when necessary like so:

```diff
public static function canAccess(): bool
{
-    return auth()->user()->can('canAccessThing');
+    return auth()->check() && auth()->user()->can('canAccessThing');
}
```

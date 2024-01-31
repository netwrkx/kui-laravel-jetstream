# K UI Laravel Jetstream

Different UI for [larave/jetstream](https://github.com/laravel/jetstream).

[![License](https://img.shields.io/github/license/Kamona-WD/kui-laravel-jetstream)](https://github.com/Kamona-WD/kui-laravel-jetstream/blob/main/LICENSE.md)

> This project is a combining of great project from [Kamona-WD](https://github.com/Kamona-WD/kui-laravel-jetstream) and 
Improving Team Invitation Flow by [Mario Giancini](https://mariogiancini.com/making-laravel-jetstream-team-invitations-better)

<!-- > Thanks to Kamona-WD for this great project. [Kamona-WD](https://github.com/Kamona-WD/kui-laravel-jetstream) -->

<!-- > Improving Team Invitation Flow by [Mario Giancini](https://mariogiancini.com/making-laravel-jetstream-team-invitations-better) -->

> We recommend installing this package on a project that you are starting from scratch.

#### Usage
> NOTE: This only works for `vitejs & inertia`. `laravel-mix & livewire` is not supported.

1. Fresh install Laravel >= 8.0 and `cd` to your app.
2. Install laravel/jetstream

```sh
composer require laravel/jetstream

# after finish run this command

php artisan jetstream:install inertia --teams
```

3. Install kamona/kui-laravel-jetstream

```sh
composer require kamona/kui-laravel-jetstream --dev

# after finish run this command

# This package will detect if your project use vitejs or not by check if vite.config.js exist or not.
php artisan kui-jetstream:replace inertia --teams
# available stacks (inertia).
# So if you run `php artisan jetstream:install inertia` you can run `php artisan kui-jetstream:replace inertia`

# then
npm install && npm run dev # or yarn && yarn dev
```

```sh
# (optional) To run team improvement flow.
php artisan kui-jetstream:invitation mariogiancini
```

4. Configure your database.
5. Run `php artisan migrate`.
6. `php artisan serve`.

> Do not forget to change `APP_URL` in `.env` file and run `php artisan storage:link` if you want to enable `manageProfilePicture` feature.

#### Navigation

You will found sidebar links in:

- inertia: `resources/js/Components/Sidebar/SidebarContent.vue`

#### Screens

|                                     |                                    |
| ----------------------------------- | ---------------------------------- |
| ![Shocase 1](screens/r-light.png)   | ![Shocase 2](screens/l-dark.png)   |
| ![Shocase 3](screens/d-light.png)   | ![Shocase 4](screens/d-dark.png)   |
| ![Shocase 5](screens/t-light.png)   | ![Shocase 6](screens/t-dark.png)   |
| ![Shocase 7](screens/api-light.png) | ![Shocase 8](screens/api-dark.png) |

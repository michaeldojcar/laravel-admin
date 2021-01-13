<?php


namespace MichaelDojcar\LaravelAdmin;


use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Load default auth and admin routes.
     *
     * @param array $options
     */
    public function routes(array $options = [])
    {
        Auth::routes($options);

        require __DIR__ . '/../routes/web.php';
    }
}
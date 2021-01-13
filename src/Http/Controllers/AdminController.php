<?php


namespace MichaelDojcar\LaravelAdmin\Http\Controllers;


use Illuminate\Routing\Controller;

/**
 * Class AdminController
 *
 * @package MichaelDojcar\LaravelAdmin\Http\Controllers
 */
class AdminController extends Controller
{
    public function index()
    {
        return view('admin::index');
    }
}
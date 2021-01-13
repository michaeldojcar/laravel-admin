<?php


namespace MichaelDojcar\LaravelAdmin\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

/**
 * Class AdminResourceController
 *
 * Basic controller for admin core resource.
 *
 * @package Modules\AdminCore\Http\Controller
 * @author Michael Dojčár
 */
abstract class AdminResourceController extends Controller
{
    /**
     * @var $resource_model Model
     */
    protected $resource_model;

    protected $prefix;

    protected $service;

    /**
     * AdminResourceController constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->checkProps();

        $this->guessResourceModel();
    }

    /**
     * Default index action.
     *
     * @return Factory|View
     */
    public function index()
    {
        $model_resource_plural_string = $this->getResourceModelNamePluralSnake();

        $resource_collection = $this->getAll();

        return $this->getViewResponseForAction('index', [
            $model_resource_plural_string => $resource_collection,
            'route_create' => $this->getRouteForAction('create'),
        ]);
    }

    /**
     * Default create action.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view($this->getViewNameForAction('create'), [
            'resource' => $this,
            'route_store' => $this->getRouteForAction('store'),
        ]);
    }

    /**
     * Default show action.
     *
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        $model = $this->findById($id);

        $model_name = $this->getModelNameSnake();

        return view($this->getViewNameForAction('show'), [
            $model_name => $model,
            'route_edit' => $this->getRouteForAction('edit', $model),
        ]);
    }

    /**
     * Default edit action.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $model = $this->findById($id);

        $model_name = $this->getModelNameSnake();

        return $this->getViewResponseForAction('edit', [
            $model_name => $model,
            'route_update' => $this->getRouteForAction('update', $model),
            'route_destroy' => $this->getRouteForAction('destroy', $model),
        ]);
    }

    /**
     * Default destroy action
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->service->delete($this->findById($id));

        return $this->redirectToIndex();
    }

    /**
     * Find model by id.
     *
     * @param $id
     * @return
     */
    public function findById($id)
    {
        return $this->resource_model::findOrFail($id);
    }

    /**
     * @return Collection|Model[]
     */
    private function getAll()
    {
        return $this->resource_model::all();
    }

    /**
     * @return string
     */
    private function getModelNameSnake()
    {
        $class_fqn = $this->resource_model;

        $path = explode('\\', $class_fqn);
        $short_name = array_pop($path);

        return Str::snake($short_name);
    }

    /**
     * @return string
     */
    private function getResourceModelNamePluralSnake()
    {
        $snake = $this->getModelNameSnake();

        return Str::plural($snake);
    }

    /**
     * @return string
     */
    private function getViewPrefix()
    {
        return $this->prefix . $this->getResourceModelNamePluralSnake();
    }

    /**
     * Get view name for resource action.
     *
     * @param $action
     * @return string
     */
    protected function getViewNameForAction($action)
    {
        return $this->getViewPrefix() . '.' . $action;
    }

    /**
     * Get view response for some resource action.
     *
     * @param $action
     * @param array $data
     * @return Factory|View
     */
    protected function getViewResponseForAction($action, $data = [])
    {
        return view($this->getViewNameForAction($action), $data);
    }

    /**
     * Get route name for some resource controller action (eg. create, store).
     *
     * @param $action
     * @return string
     */
    protected function getRouteNameForAction($action)
    {
        return $this->getViewPrefix() . '.' . $action;
    }

    /**
     * Generate route URL for action.
     *
     * @param $action
     * @param null $param
     * @return string
     */
    protected function getRouteForAction($action, $param = null)
    {
        return route($this->getRouteNameForAction($action), $param);
    }

    /**
     * Get redirect response for resource action.
     *
     * @param $action
     * @param null $subject_model Model used as subject of this route.
     * @return RedirectResponse
     */
    public function redirectToAction($action, $subject_model = null)
    {
        return redirect()->route($this->getRouteNameForAction($action), $subject_model);
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToIndex()
    {
        return $this->redirectToAction('index');
    }

    /**
     * Generate redirect response to show action route.
     *
     * @param $subject_model
     * @return RedirectResponse
     */
    public function redirectToShow($subject_model)
    {
        return $this->redirectToAction('show', $subject_model);
    }

    /**
     * Generate redirect response to edit action.
     *
     * @param $subject_model
     * @return RedirectResponse
     */
    public function redirectToEdit($subject_model)
    {
        return $this->redirectToAction('edit', $subject_model);
    }

    /**
     * @throws Exception
     */
    protected function checkProps()
    {
        if (empty($this->resource_model))
        {
            throw new Exception("Resource model class must be selected in resource controller.");
        }
    }

    protected function guessResourceModel()
    {

    }
}

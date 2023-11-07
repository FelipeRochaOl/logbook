<?php

namespace App\core;

class Route
{
    private string $route;
    private array $querystring;

    public function __construct(string $route, array $querystring)
    {
        $this->route = $route;
        $this->querystring = $querystring;
    }

    public function render()
    {
        if (!array_key_exists('page', $this->querystring)) {
            $this->querystring['page'] = '';
        }
        $this->renderPage();
    }

    private function renderPage(): void
    {
        switch ($this->querystring['page']) {
            case 'create':
            case 'edit':
                include "/var/www/admin/$this->route/form.php";
                break;
            default:
                include "/var/www/admin/$this->route/list.php";
        }
    }

    public function generateBreadcrumbs(string $uri): array
    {
        $response = [];
        $url = parse_url($uri);
        $breadcrumbs = explode('/', $url['path']);
        $breadcrumbs[0] = 'home';

        if (!empty($url['query'])) {
            parse_str($url['query'], $query);
            if (!empty($query['id'])) {
                $breadcrumbs['id'] = $query['id'];
            }
        }

        foreach (array_filter($breadcrumbs) as $breadcrumb) {
            switch ($breadcrumb) {
                case 'home':
                    $response[] = $this->responseBreadcrumb('home', "/");
                    break;
                case 'categories':
                    $response[] = $this->responseBreadcrumb('categoria', "/$breadcrumb/");
                    break;
                case 'posts':
                    $response[] = $this->responseBreadcrumb('postagens', "/");
                    break;
                default:
                    $response[] = $this->responseBreadcrumb($breadcrumb, $uri);
            }
        }
        return $response;
    }

    private function responseBreadcrumb($description, $url): object
    {
        return (object) [
            'description' => ucfirst($description),
            'url' => $url
        ];
    }
}
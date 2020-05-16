<?php
namespace Tudublin;



class MainController extends Controller
{
    public function home()
    {
        $template = 'index.html.twig';
        $args = [];
        $html = $this->twig->render($template, $args);
        print $html;
    }
    public function contact()
    {
        $templates = 'contact.html.twig';
        $args = [];
        $html = $this->twig->render($templates,$args);
        print $html;
    }

    public function about()
    {
        $templates = 'about.html.twig';
        $args = [];
        $html = $this->twig->render($templates,$args);
        print $html;
    }

    public function map()
    {
        $templates = 'sitemap.html.twig';
        $args = [];
        $html = $this->twig->render($templates,$args);
        print $html;
    }


}
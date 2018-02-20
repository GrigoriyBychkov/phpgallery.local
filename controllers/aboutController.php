<?php

class AboutController
{
    static function aboutAction()
    {
        $view = new View('views/index.phtml');
        $data = Array();
        $data['content'] = self::aboutContent();
        return $view->render($data);
    }
    static function aboutContent(){
        $view = new View('views/about.phtml');
        $data = Array();
        $data['count'] = Images::getImagesCount();
        $data['tagsCount'] = Tags::getTagsCount();

        return $view->render($data);
    }

}
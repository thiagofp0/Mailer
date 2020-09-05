<?php

    use \Api\Page;
    use Api\Controller\User;
    use Api\Controller\Template;

    $app->get('/', function () {
        User::verifyLogin();
        $templates = Template::listAll();
        $page = new Page();
        $page->setTpl('templates', ['templates'=>Template::checkList($templates)]);
    });

    $app->get('/templates', function () {
        User::verifyLogin();
        $templates = Template::listAll();
        $page = new Page();
        $page->setTpl('templates', ['templates'=>Template::checkList($templates)]);
    });

    $app->get('/templates/new', function () {
        User::verifyLogin();
        $page = new Page();
        $page->setTpl('uploadFile');
    });

    $app->post('/templates/new', function(){
        User::verifyLogin();
        $template = new Template();
        $template->setData($_POST);
        $template->save();
        header("Location: /templates");
 	    exit;
    });

    $app->get("/templates/{idTemplate}", function($req, $res, $args){
        User::verifyLogin();
        $idTemplate = $args["idTemplate"];
        $template = new Template();
        $template->getById((int)$idTemplate);
        $page = new Page();
        $page->setTpl("template", [
            'template'=>$template->getValues()
        ]);
    });

    $app->post("/templates/{idTemplate}", function($req, $res, $args){
        User::verifyLogin();
        $idTemplate = $args["idTemplate"];
        $template = new Template();
        $template->setData($_POST);
        $template->update((int)$idTemplate);
        header("Location: /templates");
 	    exit;

    });

    //Não sei o que estou fazendo aqui
    //Isso só n funciona e é isso
    $app->get("/templates/{idTemplate}/send", function($req, $res, $args){
        User::verifyLogin();
        $idTemplate = $args["idTemplate"];
        $template = new Template();
        $template->getById((int)$idTemplate);
        $page = new Page();
        $page->setTpl("template-send", [
            'template'=>$template->getValues()
        ]);
    });

    $app->post("/templates/{idTemplate}/send", function($req, $res, $args){
        //Fazer aqui ainda
    });

    //Não sei se isso funciona
    $app->get("/templates/{idTemplate}/delete", function($req, $res, $args){
        $idTemplate = $args["idTemplate"];
        User::verifyLogin();
        $template = new Template();
        $template->getById($idTemplate);
        $template->delete();
        header("Location: /templates");
        exit;
    });
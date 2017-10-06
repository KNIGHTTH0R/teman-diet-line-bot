<?php

/**
 * Created by VSCode.
 * User: luqman
 * Date: 10/06/17
 * Time: 8:49 PM
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use LINE\LINEBot\SignatureValidator;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

require 'vendor/autoload.php';

spl_autoload_register(function ($class_name){
    include  $class_name.'.php';
});

// load config
try{
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
}catch (Exception $e){
}

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new Slim\App(['settings' => $config]);
$container = $app->getContainer();

$app->get('/', function (Request $request, Response $response){
    ini_set('display_errors', 1);
    echo "it works";

});

$app->run();

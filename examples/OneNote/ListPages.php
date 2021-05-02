<?php

require_once '../vendor/autoload.php';

use Office365\Graph\GraphServiceClient;
use Office365\Graph\OnenotePage;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;

function acquireToken()
{
    $settings = include('../../Settings.php');
    $resource = "https://graph.microsoft.com";
    $provider = new AADTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
        new UserCredentials($settings['UserName'], $settings['Password']));
}


$client = new GraphServiceClient("acquireToken");

$pages = $client->getMe()->getOneNote()->getPages()->get()->executeQuery();
/** @var OnenotePage $page */
foreach ($pages as $page){
    echo "Number of pages: " . $page->getTitle();
}



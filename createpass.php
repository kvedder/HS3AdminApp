<?php

include('connect.php');
include('./inc/cleeng/cleeng_api.php');

   /* $publisherToken = 'LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj';

    $offerSetup = array(
    'title' => 'Get access to every article about finance for whole month!',
    'price' => 13.00,
    'url' => 'http://mywebsite.com/tag/finance',
    'description' => 'Whole month you have unlimited access to every article about finance.',
    'period' => 'month',
    'accessToTags' => array('finance')
    );

    $cleengApi = new Cleeng_Api();
    $cleengApi->setPublisherToken($publisherToken);
    $cleengOffer = $cleengApi->createPassOffer($offerSetup); */



    $offerSetup = array(
    'title' => 'Bip Bip and Coyote - Season 4 ALL EPISODES',
    'price' => 0.49,
    'url' => 'http://your-site.com/watch/bipbip_4/',
    'description' => 'See how Bip Bip and Coyote are chasing each other. One purchase all episodes!',
    'offerIdList' => array('A323985960_US', 'A358550286_US')
    );

    $cleengApi = new Cleeng_Api();
    $cleengApi->setPublisherToken('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');

    $cleengApi->createBundleOffer($offerSetup);

    ?>
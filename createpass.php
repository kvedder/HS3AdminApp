'<?php

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
    'associateEmail' => 'testschool@hs3.tv',
    'price' => 0.49,
    'url' => 'http://your-site.com/watch/bipbip_4/',
    'description' => 'See how Bip Bip and Coyote are chasing each other. One purchase all episodes!',
    'period' => 'year',
    'accessToTags' => array('football')

    );

    $cleengApi = new Cleeng_Api();
    $cleengApi->enableSandbox();
    $cleengApi->setPublisherToken('RrqDJhkbxJA9g9W7QQ2SW3BJLdALJgxPBlf9pj5W8NIPJ_Fh');

    $cleengApi->createPassOffer($offerSetup);

    ?>
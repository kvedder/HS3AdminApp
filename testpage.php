<?php
require_once('./inc/cleeng/cleeng_api.php');


$cleengApi = new Cleeng_Api();

		$cleengApi->setDistributorToken('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');
		$associateData = array(
		//	'distributorToken' => 'LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj',
			'email' => 'spencerville@hs3.tv',
			'locale' => 'en_US',
			'country' => 'US',
			'currency' => 'USD',
			'siteName' => 'Spencerville High School',
			'siteURL' => 'http://spencerville.hs3.tv',
				);
		$result = $cleengApi->createAssociate($associateData);

		var_dump($result);
		?>
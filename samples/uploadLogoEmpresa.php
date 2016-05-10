<?php
	header('Content-Type: text/html; charset=utf-8');
	
	require('../src/eNotasGW.php');
	
	use eNotasGW\Api\Exceptions as Exceptions;
	use eNotasGW\Api\fileParameter as fileParameter;

	eNotasGW::configure(array(
		'apiKey' => 'YmZiMmFjZmQtOTc4MC00ZDdhLThiOGUtOTgwMWY4MTQwMTAw',
		//'baseUrl' => 'http://localhost:8081'
	));
	
	$empresaId = '37D8C01E-0D9C-434E-B5C3-CE21F8140100';
	
	try
	{
		$file = fileParameter::fromPath('C:\Virtual Group\eNotas\Trunk\ENotas.NFeService\ENotas.NFeService.Application.Provedores\Operacoes\Reports\Images\eNotas-black.png', 
			'image/png', 'logo.png');
		
		eNotasGW::$EmpresaApi->atualizarLogo($empresaId, $file);
		echo 'Logo atualizada com sucesso!';
	}
	catch(Exceptions\invalidApiKeyException $ex) {
		echo 'Erro de autenticação: </br></br>';
		echo $ex->getMessage();
	}
	catch(Exceptions\unauthorizedException $ex) {
		echo 'Acesso negado: </br></br>';
		echo $ex->getMessage();
	}
	catch(Exceptions\apiException $ex) {
		echo 'Erro de validação: </br></br>';
		echo $ex->getMessage();
	}
	catch(Exceptions\requestException $ex) {
		echo 'Erro na requisição web: </br></br>';
		
		echo 'Requested url: ' . $ex->requestedUrl;
		echo '</br>';
		echo 'Response Code: ' . $ex->getCode();
		echo '</br>';
		echo 'Message: ' . $ex->getMessage();
		echo '</br>';
		echo 'Response Body: ' . $ex->responseBody;
	}
?>
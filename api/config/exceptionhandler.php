<?php

/**
 * Exception handler
 *
 * @author Elli Motazedi W19039439
 */
	 
class GeneralExceptionHandler {
			
	public static function exceptionHandler($e) {
	   http_response_code(500);
	   $fileHandle = fopen("logErrors.log", "ab");
	   $errorDate = date('D M j G:i:s T Y');
			
	   $output['message'] = $e->getMessage();
	   
	   $output['location']['file'] = $e->getFile();
	   $output['location']['line'] = $e->getLine();
	   
	   fwrite($fileHandle, "$errorDate|".$output['message']."|".$output['location']['file']."|".$output['location']['line'].PHP_EOL);
	   fclose($fileHandle);

	   echo json_encode($output);
	}
}

?>
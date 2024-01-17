<?php

/**
 * Error handler
 *
 * Throw an exception if the error is not a warning (2) or notice (8). 
 * Do nothing otherwise
 *
 * @author Elli Motazedi W19039439
 */
	
class GeneralErrorHandler{
	 
	public static function errorHandler($errno, $errstr, $errfile, $errline) {
		$fileHandle = fopen("logErrors.log", "ab");
		$errorDate = date('D M j G:i:s T Y');
			
		if ($errno != 2 && $errno != 8) {
			// 2: Run-time warnings (non-fatal errors). Execution of the script is not halted
			// 8: Run-time notices. Indicate that the script encountered something that could indicate an error, but could also happen in the normal course of running a script.
			$errorMessage = $errno->getMessage();
				
			fwrite($fileHandle, "$errorDate|$errorMessage".PHP_EOL);
			fclose($fileHandle);
	   }
	}
}

?>
<?php
 
 /**
 * Endpoint for handling client errors (400 responses)
 * 
 * @author Elli Motazedi W19039439
 */
 
class ClientError extends Endpoint
{
    public function __construct($message = "", $code = 400) {
        http_response_code($code);
 
        $this->setData( array(
            "length" => 0,
            "message" => $message,
            "data" => null
        ));
    }
}

?>
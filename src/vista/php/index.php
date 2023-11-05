<?php
header("Content-type: application/json; charset=utf-8");
http_response_code($this->datos->codigo);
//echo $this->json;
echo json_encode($this->datos->respuesta);
//echo $this->articulos;
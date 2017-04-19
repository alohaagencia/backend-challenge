<?php
// Routes

// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });

$app->group('/api', function () {

	$this->get('/list', function ($request, $response, $args) {
		$sql = "SELECT * FROM list";

	    $result = $this->db->prepare($sql);
	    $result->execute();
	    $contatos = $result->fetchAll();

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')        
            ->withHeader('Content-Type', 'application/json')->withJson($contatos);
	});

	$this->get('/list/[{id}]', function ($request, $response, $args) {
        $result = $this->db->prepare("SELECT * FROM list WHERE id=:id");
        $result->bindParam("id", $args['id']);
        $result->execute();
        $contatos = $result->fetchObject();
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')        
            ->withHeader('Content-Type', 'application/json')->withJson($contatos);
    });


	$this->post('/list', function ($request, $response) {
	    $input = $request->getParsedBody();

	    $sql = "INSERT INTO list (name, tel, cel) VALUES (:name, :tel, :cel)";

	    $result = $this->db->prepare($sql);
	    $result->bindParam("name", $input['name']);
	    $result->bindParam("tel", $input['tel']);
	    $result->bindParam("cel", $input['cel']);
	    $result->execute();

	    $input['id'] = $this->db->lastInsertId();

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')        
            ->withHeader('Content-Type', 'application/json')->withJson($input)
            ->withRedirect("http://localhost/aloha_catfront/#!/");
	});

    $this->delete('/list/[{id}]', function ($request, $response, $args) {
        $result = $this->db->prepare("DELETE FROM list WHERE id=:id");
        $result->bindParam("id", $args['id']);
        $result->execute();
        // $contato = $result->fetchAll();
        // return $this->response->withJson($contato);
    });

   $this->put('/list/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE list SET name=:name, tel=:tel, cel=:cel WHERE id=:id";
        $result = $this->db->prepare($sql);
        $result->bindParam("id", $args['id']);
        $result->bindParam("name", $input['name']);
        $result->bindParam("tel", $input['tel']);
        $result->bindParam("cel", $input['cel']);
        $result->execute();
        $input['id'] = $args['id'];
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')        
            ->withHeader('Content-Type', 'application/json')->withJson($contatos);
    });  

});
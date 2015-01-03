var http = require("http");

// http.createServer(function(request, response){
//     response.writeHead(200);
//     response.write("Ola mundo, este eh meu servidor");
//     response.end();
// }).listen(8880);

// Events
// var server = http.createServer();

// server.on('request', function(req, res){
//     res.writeHead(200);
//     res.end("Ola mundo, este eh meu servidor");
// });

// server.listen(8882);

// var server = http.createServer();

// server.on('request', function(req, res){
//     res.writeHead(200);
//     res.write("Servidor mandou os primeiros dados do response");
//     setTimeout(function () {
//     	res.write("Mandando o segundo pacote...");
//     	res.end();
//     }, 5000);
// });

// server.listen(8882);


var server = http.createServer();

server.on('request', function(req, res){
    res.writeHead(200);

    req.pipe(res);

    // req.on('data', function(chunk){
    // 	// console.log(chunk.toString());
    // 	res.write(chunk);
    // });

    // req.on('end', function(){
    // 	res.end('acabou');
    // });
});

server.listen(8882);


console.log("Servidor Iniciado");

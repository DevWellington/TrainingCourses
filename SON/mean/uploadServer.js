var http = require('http');
var fs = require('fs');

var server = http.createServer(function(req, res){
	
	var novoArquivo = fs.createWriteStream('arquivo.txt');
	var size = req.headers['content-length'];
	var uploded = 0;

	req.pipe(novoArquivo);

	req.on('data', function(chunk){
		uploded += chunk.length;

		var progress = (uploded / size) * 100;

		res.write('progress: '+parseInt(progress, 10) + '%\n');
	});



	res.writeHead(200);
	req.pipe(res);
});

server.listen(8882);
var fs = require('fs');

var file = fs.createReadStream('content.txt');
var novo = fs.createWriteStream('content_novo.txt');

file.pipe(novo);

var EventEmitter = require("events").EventEmitter;

// logger - erro, aviso, info;
var logger = new EventEmitter();

logger.on('error', function(message){
	console.log("Erro: " + message);
});

logger.on('aviso', function(message){
	console.log("Aviso: " + message);
});

logger.on('info', function(message){
	console.log("Info: " + message);
});

logger.emit('error', "Ola meu erro.");
logger.emit('aviso', "Ola meu aviso.");
logger.emit('info', "Ola meu info.");
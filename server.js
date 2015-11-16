var io = require('socket.io')(80);
var rooms = [];
io.on('connection', function (socket) {
	socket.on('create', function (data)) {
		rooms.push(data);
	}
	socket.on('join', function (data) {
		socket.join(data.room);
		for (rooms in room){
			
		}
		socket.emit('members', );
	});
});
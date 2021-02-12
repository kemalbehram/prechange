var http = require('http'),
qs = require('querystring');
var server = http.createServer(function(req, res) {
	if (req.method === 'POST') {
		var body = '';
		req.on('data', function(chunk) {
			body += chunk;
		});
		req.on('end', function() {
			var data = JSON.parse(body);
			var CAValidator = require('cryptocurrency-address-validator');
			var valid = CAValidator.validate(data.address, data.coin);
			// var valid = CAValidator.validate('0xecdf3210227ce060340bd98f637ad86a99c913c2', 'eth');
			if(valid){
				var result = 'correct';
			}
			else{
				var result = 'wrong';
			}

			var obj = {
				'result' : result.toString(),
			};

			res.writeHead(200);
			res.end(JSON.stringify(obj));
		});
	} else {
		res.writeHead(404);
		res.end();
	}
});

 server.listen(8070, '167.71.152.74');
// server.listen(8070, '127.0.0.1');

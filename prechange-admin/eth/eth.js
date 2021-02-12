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
		var Url = data.url;
		var Web3 = require('web3');

		if(typeof web3 !== 'undefined') {
			web3 = new Web3(web3.currentProvider);
		} else {
			web3 = new Web3(new Web3.providers.HttpProvider(Url));
		}
		
		if(data.method === 'create_address'){
			try {
				var keypair = web3.shh.newKeyPair();
				var hash = web3.shh.hasKeyPair(keypair);
				var getprivatekey = web3.shh.getPrivateKey(keypair);
				var addprivatekey = web3.shh.addPrivateKey(getprivatekey);
				var account = web3.personal.importRawKey(addprivatekey,data.psw);
				var obj = {
					'address' : account,
					'privatekey' : addprivatekey
				};
			}
			catch(err) {
				console.log(err);
			}
		}
		if(data.method === 'create_rawtx'){
			try {
				var EthereumTx = require('ethereumjs-tx');
				var privateKey = new Buffer.from(data.pvk, 'hex');
				var count = web3.eth.getTransactionCount(data.formaddr);
				var txParams = {
					from: data.formaddr,
					nonce: web3.toHex(count),
					gasPrice: web3.toHex(20000000000),
					gas: web3.toHex(21000),
					to: data.toddr,
					value: web3.toHex(web3.toWei(data.amount, 'ether')),
					data: "",
					chainId: web3.toHex(1)
				};
				var tx = new EthereumTx(txParams);
				tx.sign(privateKey);
				var serializedTx = tx.serialize();
				console.log(serializedTx);
				web3.eth.sendRawTransaction('0x' + serializedTx.toString('hex'), function(error, txid){
					if(error){
						var obj = { "error" : error };
					} else {
						var obj = {
							"txid" : txid
						};
						res.writeHead(200);
						res.end(JSON.stringify(obj));
					}
					
				});
			}
			catch(err) {
				console.log(err);
			}
		}

		if(data.method === 'create_rawgnc'){
			try {
				var contractAddress= "0xeb09ee9f510d87ffdff43e16cc4683a8a6288534";
				var EthereumTx = require('ethereumjs-tx');
				var privateKey = new Buffer.from(data.pvk, 'hex');
				var count = web3.eth.getTransactionCount(data.formaddr);
				var abiArray = [{"varant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"varant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"varant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"varant":false,"inputs":[{"name":"_value","type":"uint256"}],"name":"burn","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_subtractedValue","type":"uint256"}],"name":"decreaseApproval","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"varant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_value","type":"uint256"}],"name":"burnFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"varant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"varant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_addedValue","type":"uint256"}],"name":"increaseApproval","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":false,"inputs":[{"name":"tokenAddress","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferAnyERC20Token","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"varant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"varant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"varructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"}],"name":"OwnershipRenounced","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"burner","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Burn","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"}];
				var contract = web3.eth.contract(abiArray).at(contractAddress);
				let result = contract.transfer.estimateGas(data.toddr, data.amount, {from: data.formaddr});
				var amount = data.amount;
				var txParams = {
					"from": data.formaddr,
					"nonce": web3.toHex(count),
					"gasPrice": web3.toHex(20000000000),
					"gasLimit": web3.toHex(result),
					"to": contractAddress,
					"value": web3.toHex(0),
					"data": contract.transfer.getData(data.toddr, data.amount, {from: data.formaddr}),
					"chainId": web3.toHex(1)
				};

				var tx = new EthereumTx(txParams);
				tx.sign(privateKey);
				var serializedTx = tx.serialize();
				console.log(serializedTx);
				web3.eth.sendRawTransaction('0x' + serializedTx.toString('hex'), function(error, txid){
					if(error){
						var obj = { "error" : error };
					} else {
						var obj = {
							"txid" : txid
						};
						res.writeHead(200);
						res.end(JSON.stringify(obj));
					}

				});
			}
			catch(err) {
				console.log(err);
			}
		}
		if(data.method === 'get_balance'){
			try{
				web3.eth.getBalance(data.address, function(error, balance){
					if(!error){
						console.log(balance.toString(10));
					} else {
						var obj = { "error" : error };
					}
				});
			}
			catch(err) {
				console.log(err);
			}
		}
		
		
	});
  } else {
    res.writeHead(404);
    res.end();
  }
});
server.listen(8545, '45.76.25.116');

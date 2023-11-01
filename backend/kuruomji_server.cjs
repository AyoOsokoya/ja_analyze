const http = require('node:http');
const kuromoji = require("kuromoji");
const DIC_DIR = "node_modules/kuromoji/dict/";
const url = require('url');


const hostname = '127.0.0.1';
const port = 3000;

// TODO: Error handling when length is zero or non string
const server = http.createServer((req, res) => {
    kuromoji.builder({ dicPath: DIC_DIR }).build(function (error, tokenizer) {
        res.statusCode = 200;
        res.setHeader('Content-Type', 'text/plain; charset=utf-8');

        let paragraph = url.parse(req.url, true).query['keyword'];
        let path = [];
        if (typeof(paragraph) === "string") {
            path = tokenizer.tokenize(paragraph);
        }
        console.log(path);
        res.end(JSON.stringify(path));
        module.exports = tokenizer;
    });
}).listen(port, hostname, () => {
    console.log(`Kuromoji Server running at http://${hostname}:${port}/`);
});

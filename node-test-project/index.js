import { createServer } from 'http';
// see calc.es6.js
// calc = export default
// { add } = export
import calc, { add } from './calces6.mjs';
 
const server = createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/plain');
    res.end(`Hello world and testing and its ${calc.add(40, 2)}!!!`);
});
 
server.listen(3000, () => {
    console.log('Server läuft auf http://localhost:3000');
});
 
 
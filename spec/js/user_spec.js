'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _frisby = require('frisby');

var _frisby2 = _interopRequireDefault(_frisby);

var HOST = 'localhost:8080/api/';
var MODEL = 'users';
var ID = 12;

/* INDEX */

_frisby2['default'].create('INDEX').get('http://' + HOST + MODEL).expectHeaderContains('content-type', 'application/json').expectStatus(200).expectJSONTypes({
  status: 'FOUND',
  data: [{
    name: 'taro',
    email: 'taro@example.com'
  }]
}).inspectJSON().toss();

/* create */

_frisby2['default'].create('CREATE').post('http://' + HOST + MODEL, {
  'name': 'frisby',
  'email': 'frisby@example.com'
},
// json trueをいれないと409errorが返ってくる
{ json: true }).expectHeaderContains('content-type', 'application/json').expectStatus(201).expectJSONTypes({
  status: 'OK'
}).inspectJSON().toss();

/* READ */

_frisby2['default'].create('READ').get('http://' + HOST + MODEL + '/' + ID).expectHeaderContains('content-type', 'application/json').expectStatus(200).expectJSONTypes({
  status: 'FOUND',
  data: {
    name: 'frisby',
    email: 'frisby@example.com'
  }
}).inspectJSON().toss();

/* UPDATE */

_frisby2['default'].create('UPDATE').put('http://' + HOST + MODEL + '/' + ID, {
  'id': ID,
  'name': 'frisbyupdate',
  'email': 'frisbyupdate@example.com'
}, { json: true }).expectHeaderContains('content-type', 'application/json').expectStatus(200).expectJSONTypes({
  status: 'OK'
}).inspectJSON().toss();

/* DELETE */

_frisby2['default'].create('DELETE')['delete']('http://' + HOST + MODEL + '/' + ID).expectHeaderContains('content-type', 'application/json').expectStatus(205).expectJSONTypes({
  status: 'OK'
}).inspectJSON().toss();
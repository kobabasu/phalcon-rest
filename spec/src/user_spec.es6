import frisby from 'frisby'

const HOST       = 'localhost:8080/api/'
const MODEL      = 'users'
const ID         = 12


/* INDEX */

frisby.create('INDEX')
  .get('http://' + HOST + MODEL)
  .expectHeaderContains('content-type', 'application/json')
  .expectStatus(200)
  .expectJSONTypes({
    status: 'FOUND',
    data: [
      {
        name: 'taro',
        email: 'taro@example.com'
      }
    ]
  })
  .inspectJSON()
  .toss();


/* create */

frisby.create('CREATE')
  .post(
    'http://' + HOST + MODEL,
    {
      "name": "frisby",
      "email": "frisby@example.com"
    },
    // json trueをいれないと409errorが返ってくる
    {json: true}
  )
  .expectHeaderContains('content-type', 'application/json')
  .expectStatus(201)
  .expectJSONTypes({
    status: 'OK'
  })
  .inspectJSON()
  .toss();


/* READ */

frisby.create('READ')
  .get('http://' + HOST + MODEL + '/' + ID)
  .expectHeaderContains('content-type', 'application/json')
  .expectStatus(200)
  .expectJSONTypes({
    status: 'FOUND',
    data:
      {
        name: 'frisby',
        email: 'frisby@example.com'
      }
  })
  .inspectJSON()
  .toss();


/* UPDATE */

frisby.create('UPDATE')
  .put(
    'http://' + HOST + MODEL + '/' + ID,
    {
      "id": ID,
      "name": "frisbyupdate",
      "email": "frisbyupdate@example.com"
    },
    {json: true}
  )
  .expectHeaderContains('content-type', 'application/json')
  .expectStatus(200)
  .expectJSONTypes({
    status: 'OK'
  })
  .inspectJSON()
  .toss();


/* DELETE */

frisby.create('DELETE')
  .delete('http://' + HOST + MODEL + '/' + ID)
  .expectHeaderContains('content-type', 'application/json')
  .expectStatus(205)
  .expectJSONTypes({
    status: 'OK'
  })
  .inspectJSON()
  .toss();

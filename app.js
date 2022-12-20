/* 설치한 express 모듈 불러오기 */
const express = require('express')
/* Node.js 기본 내장 모듈 불러오기 */
const fs = require('fs')

var querystring = require('querystring');

/* express 객체 생성 */
const app = express()
const session = require('express-session')
/* 설치한 socket.io 모듈 불러오기 */
const socket = require('socket.io')


const https = require('https')

let sslKeys = {};
sslKeys = {
  ca: fs.readFileSync('/etc/letsencrypt/live/mapleshortcut.ml/fullchain.pem'),
  key: fs.readFileSync('/etc/letsencrypt/live/mapleshortcut.ml/privkey.pem'),
  cert: fs.readFileSync('/etc/letsencrypt/live/mapleshortcut.ml/cert.pem'),
};

/* Node.js 기본 내장 모듈 불러오기 */
const server = https.createServer(sslKeys, app)
/* 생성된 서버를 socket.io에 바인딩 */
const io = require("socket.io")(server)


const path = require('path')
var bodyParser = require('body-parser');
const res = require('express/lib/response');
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
/* express http 서버 생성 */

app.use(express.static(path.join(__dirname, "/")))

var nickName
/* Get 방식으로 / 경로에 접속하면 실행 됨 */
app.post('/', function (request, response) {

  fs.readFile('index.html', function (err, data) {
    if (err) {
      response.send('에러')
    } else {
      nickName = request.body.nickName;

      response.writeHead(200, { 'Content-Type': 'text/html' })
      response.write(data)
      response.end()
    }
  })

})



io.on('connection', function (socket) {
  /* 새로운 유저가 접속했을 경우 다른 소켓에게도 알려줌 */
  socket.on('newUser', function (name) {
    console.log(nickName + ' 님이 접속하였습니다.')

    /* 소켓에 이름 저장해두기 */
    socket.name = nickName

    



    /* 모든 소캣에게 전송 */
    io.sockets.emit('update', { type: 'nickName', name: 'SERVER', nickName: nickName })
    io.sockets.emit('update', { type: 'connect', name: 'SERVER', message: nickName + '님이 접속하였습니다.' })
  })

  /* 전송한 메세지 받기 */
  socket.on('message', function (data) {
    /* 받은 데이터에 누가 보냈는지 이름을 추가 */


    data.name = socket.name


    /* 보낸 사람을 제외한 나머지 유저에게 메세지 전송 */
    socket.broadcast.emit('update', data)
  })

  /* 접속 종료 */
  socket.on('disconnect', function () {
    
    
    /* 나가는 사람을 제외한 나머지 유저에게 메세지 전송 */
    socket.broadcast.emit('update', { type: 'disconnect', name: 'SERVER', message: socket.name + '님이 나가셨습니다.' })
  })

  socket.on('send', function (data) {
    console.log('전달된 메시지:', data.msg)
  })

  socket.on('disconnect', function () {
    console.log('접속 종료')
  })
})

/* 서버를 8080 포트로 listen */
server.listen(8080, function () {
  console.log('서버 실행 중입니다.')
})

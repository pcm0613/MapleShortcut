var app  = require('express')();
var http = require('http').Server(app);
/* express를 이용하여 http서버를 생성 */
var io   = require('socket.io')(http, {cors: {origin: '*',}});

http.listen(8915, () => {
        console.log( '==================' );
        console.log( '[  Server Start  ]' );
        console.log( '==================' );

        var count=1;
        io.on('connection', function( socket ){
                //클라이언트가 서버에 접속했을 때 connection 이벤트가 발생
                console.log( '==================' );
                console.log( '[ Socket Connect ]' );
                console.log( '==================' );
                console.log( '[ User Connect : ', socket.id, ' ]' );
                var name = 'user' + count++;

                socket.name = name;
                io.to(socket.id).emit( 'nameSet', socket.name );

                socket.on('disconnect', function( socket ){
                        var msg = {};
                        console.log( '[ disconnect User : ', socket.userId, ' ]' );
                        msg = {'userId' : socket.userId,
                               'sysMsg' : socket.userId+'퇴장' };
                        io.emit( 'bye', msg );
                        });

                socket.on('send', function( socket ){
                        var msg    = {};
                        console.log( '==========================' );
                        console.log( 'UserID : ', socket.userId );
                        console.log( 'Message : ', socket.userMsg );
                        console.log( '==========================' );
                        msg = { 'userId'  : socket.userId,
                                'userMsg' : socket.userMsg };
                        io.emit( 'receve', msg );
                        });
                });
        //io는 연결된 전체 클라이언트와 상호 작용을 위한 객체
        //socket은 개별 클라이언트와 상호작용을 위한 객체
        });
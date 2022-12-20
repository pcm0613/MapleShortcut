<html>

<head>
    <title>apache node.js test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <script type='text/javascript' src='http://127.0.0.1:8915/socket.io/socket.io.js'></script>
    <script src="//code.jquery.com/jquery-1.11.1.js"></script>
    <script>
    var socket = io.connect('http://127.0.0.1:8915');

    function send(){
        var userId  = $('#name');
        var userMsg = $('#message');
        var msg     = { 'userId'  : userId.val(),
                        'userMsg' : userMsg.val() };
        socket.emit( 'send', msg );
        userMsg.val('');
        userMsg.focus();
    }

    socket.on('nameSet', function( name ){
            $('#name').val(name);
            });

    socket.on('receve', function( data ){
            var chat     = $('#chatLog');
            var thisUser = $('#name');
            var html     = '';

            if( thisUser.val() == data.userId ) {
              html = '<div class="mySelf">'+
                       '<div class="sendUser">'+data.userId+'</div>'+
                       '<div class="userMSG">'+data.userMsg+'</div>'+
                     '</div><br/>';
            } else {
              html = '<div class="others">'+
                       '<div class="sendUser">'+data.userId+'</div>'+
                       '<div class="userMSG">'+data.userMsg+'</div>'+
                     '</div><br/>';
            }

            chat.append( html );
            chat.scrollTop(chat[0].scrollHeight);
            console.log( data );
            });
    </script>
    <style>
    .chat_log{ width: 95%; height: 200px; border: inset 3px black; overflow-y:scroll; }
    .mySelf{ float:right; clear:both; margin:0; }
    .others{ float:left; clear:both; margin:0; }
    .sendUser{ font-size:13px; }
    .mySelf .sendUser{ text-align:right; }
    .others .sendUser{ text-align:left; }
    .userMSG{ font-size:15px; padding:5px; max-height:15px; }
    .mySelf .userMSG{ background:yellow; }
    .others .userMSG{ background:#888; }
    .name{ width: 10%; }
    .message{ width: 70%; }
    .chat{ width: 10%; }
    </style>
</head>

<body>
    <div>
        <div id="chatLog" class="chat_log"></div>
    </div>
    <form id="chat">
        <input id="name" class="name" type="text" readonly />
        <input id="message" class="message" type="text" onkeyup="if( event.keyCode==13 ){ send(); }">
        <button type="button" onclick="send();">chat</button>
    </form>
    <div id="box" class="box"></div>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

        <style>
            .chat-row{
                margin: 50px;
            }

            ul{
                padding: 0;
                margin: 0;
                list-style: none;
            }
            ul li{
                padding: 8px;
                background-color: #928787;
                margin-bottom: 20px;

            }

            ul li:nth-child(2n-2){
                background-color: #c5c5c5;
            }

            .chat-input{
                border: 1px solid lightcoral;
                border-radius: 20px;
                border-top-left-radius: 10px;
                padding: 8px 10px;
                color: white;
            }
        </style>

    </head>
    <body>


    <div class="container">
        <div class="row chat-row">
            <div class="chat-content">
                <ul>

                </ul>
            </div>
            <div class="chat-section">
                <div class="chat-box">
                    <div class="chat-input bg-primary" id="chatInput" contenteditable="">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
    <script>
        $(function () {
            let ipAddress = "127.0.0.1";
            let socket_port = "3000";
            let socket = io(ipAddress+":"+socket_port);

            let chatInput = $("#chatInput");
            chatInput.keypress(function(e){
                let message = $(this).html();
                console.log(message);
                if(e.which===13 && !e.shiftKey)
                {
                    socket.emit('sendChatToServer',message);
                    chatInput.html('');
                    return false;
                }

            });

            socket.on("sendChatToClient",(message)=>{
                $(".chat-content ul").append(`<li>${message}</li>`);
            });
          });
    </script>
    </body>
</html>

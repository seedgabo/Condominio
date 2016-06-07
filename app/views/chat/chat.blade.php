<head>
    <script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
    <script>
    var referencia= 'chat/';
    var user= "{{ Auth::user()->nombre}}";
    var residencia = "{{Auth::user()->residencia->nombre}}";
    var audio = new Audio("{{asset('new.mp3')}}");
    </script>
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
</head>
<body>
    <div id="chat">

        <div v-for="message in messages" v-bind:class="{ 'bubble-owner': message.user == user, 'bubble':  message.user != user }">
            <span class="user">
                <b>@{{message.user}} | @{{message.residencia}}:</b>
            </span> @{{message.mensaje}}
        </div>
        <div class="bottom">
            <input type="text" class="textarea" v-model="message" placeholder="Escribe tu mensaje aqui..." v-on:keyup.enter="addToChat()">
            <div class="sender" @click="addToChat()">
                <i class="fa fa-2x" v-bind:class="{'fa-send': message.length !=0 , 'fa-paperclip': message.length == 0}"> </i>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
    <script src="{{asset('js/chat.js')}}"></script>
</body>

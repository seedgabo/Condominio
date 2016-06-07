config = {
    apiKey: "AIzaSyA4RG2mdn_BoLX9PBFY8aBmjm9t_kT1ea8",
    authDomain: "residencias-online.firebaseapp.com",
    databaseURL: "https://residencias-online.firebaseio.com",
    storageBucket: "residencias-online.appspot.com",
};
firebase.initializeApp(config);
var chat = [];
var count = 1;
Firechat = firebase.database().ref(referencia);
Firechat.limitToLast(50).on('child_added', function( data){
    chat.push(data.val());
    audio.play();
    $("html, body").animate({ scrollTop: ($(document).height() + 1000) }, 50);

});
var demo=new Vue({
    el: '#chat',
    data: {
        messages: chat,
        user: user,
        residencia: residencia,
        message: ''
    },
    methods: {
        addToChat: function () {
            if(this.message != ''){
                Firechat.push({
                    mensaje: this.message,
                    user: this.user,
                    residencia: this.residencia,
                    timestamp: new Date().getTime()
                });
                this.message = '';
            }
        }
    }
});

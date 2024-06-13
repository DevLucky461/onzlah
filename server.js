var app = require('express')();
var http  = require('http').Server(app);
var Redis = require('ioredis');
const { data } = require('jquery');
var redis = new Redis;
var io = require('socket.io')(http);

var users = [];

    http.listen(3000, function(){
        console.log('Listening to port 3000');
    })


    redis.subscribe('stream-channel', function(){
        console.log('subscribe to stream-channel');
    });

    redis.on('message', function(channel, message){
        parsed_message = JSON.parse(message);
        if(channel == 'stream-channel'){
            let data = parsed_message.data.data;
            console.log(JSON.stringify(data));
            io.to('video_room'+  data.stream_id).emit('messages', data);
            io.to('mobile_room'+  data.stream_id).emit('mobile_messages', JSON.stringify(data));
            io.to('admin-room').to('observer_room').emit('messages', data);
        }
    });

    var roomcount = [];
    io.on('connection', function(socket){

        socket.on("user_connected", function(user_id , stream_id, user_name, type, client){
            console.log("user_id: ", user_id);
            console.log("stream_id: ", stream_id);
            console.log("user_name: ", user_name);
            console.log("type: ", type);
            var rand_user = Math.floor((Math.random() * 10) + 1);
            rand_user = 0;
            if (type == 'user'){
                console.log(user_name+" is socketed to video_room"+ stream_id);
                socket.join('video_room'+ stream_id);
            }
            else if (type == 'observer'){
                console.log(user_name+" is socketed to observer_room");
                socket.join('observer_room');
            }
            if (client == 'mobile'){
                socket.join('mobile_room'+ stream_id);
            }
            if(!roomcount['video_room'+ stream_id]) roomcount['video_room'+ stream_id] = 0;
            if(roomcount['video_room'+ stream_id] < 600){
                roomcount['video_room'+ stream_id] += (1+rand_user);
            }
            else {
                roomcount['video_room'+ stream_id] += 1;
            }
            console.log('Room '+stream_id+' login: '+roomcount['video_room'+ stream_id]);
            socket.to('video_room'+ stream_id ).to('observer').emit('user enter the chat', user_name+" and "+rand_user+" others");
            returncount(stream_id, 'video_room'+ stream_id);
            returncount(stream_id, 'admin-room');
            returncount(stream_id, 'observer_room');

            socket.on("disconnect", function(){
                roomcount['video_room'+ stream_id] -= 1;
                console.log('Room '+stream_id+' logout: '+roomcount['video_room'+ stream_id]);
                if (roomcount['video_room'+ stream_id] == 0) delete roomcount['video_room'+ stream_id];
                returncount(stream_id, 'video_room'+ stream_id);
                returncount(stream_id, 'admin-room');
                returncount(stream_id, 'observer_room');
                //io.to('video_room'+ stream_id).emit('user-disconnects', user_name);
            });

            socket.on('send-sticker', (data)=>{
                console.log(data);
                io.to('video_room'+ stream_id ).emit('receive-sticker', data);
            });

        });
        socket.on("admin-quiz-panel", function(eventid){
            console.log('someone socketed to admin-room');
            socket.join('admin-room');
            returncount(eventid, 'admin-room');
            socket.on("quiz-send", function(event_id){
                console.log('fired quiz to the correct room');
                socket.to('video_room'+ event_id).to('observer_room').emit('pop-quiz')
            });
            socket.on("result-send", function(event_id,question_id){
                console.log(question_id);
                socket.to('video_room'+ event_id).to('observer_room').emit('pop-result', question_id);
            });
            socket.on("fire-scoreboard", function(event_id, user_id, prize_money){
                windata = {}
                windata.user_id = user_id;
                windata.prize_money = prize_money;
                console.log(user_id,prize_money);
                console.log(JSON.stringify(windata));
                socket.to('video_room'+ event_id).to('observer_room').emit('pop-scoreboard', user_id, prize_money);
                socket.to('mobile_room'+ event_id).emit('pop-scoreboard-mobile', JSON.stringify(windata));
            })
        });

        socket.on('getcount', function(eventid){
            socket.join('countroom');
            returncount(eventid);
        });
    });

    function returncount(eventid, room){
        if (roomcount['video_room'+ eventid]){
            io.to(room).emit('receivecount', roomcount['video_room'+ eventid]);
            console.log('sent to room '+room+' the amount: '+roomcount['video_room'+ eventid])
        }
        else {
            console.log('no people: 0 ');
            io.to(room).emit('receivecount', 0);
        }
    }





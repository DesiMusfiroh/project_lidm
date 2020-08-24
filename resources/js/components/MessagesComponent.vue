<style>
    /* #chat-area{
        overflow-y: scroll;
    } */

    #chat{
        right:20px;
        bottom: 20px;
        position:fixed;
    }
    #end{
        left:20px;
        bottom: 20px;
        position:fixed;
    }
    #leave{
        right:20px;
        top: 20px;
        position:fixed;
    }
        /* The popup chat - hidden by default */
    .chat-popup {
    display: none;
    position: fixed;
    bottom: 0;
    right: 15px;
    border: 3px solid #f1f1f1;
    z-index: 9;
    }
    /* Add styles to the form container */
    .form-container {
    max-width: 300px;
    padding: 10px;
    background-color: white;
    }
    #chatarea {
        overflow-y:scroll;
        overflow-x:auto;
    }
    /* Full-width textarea */
    .form-container #chatarea {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    resize: none;
    height: 360px;
    }
    /* When the textarea gets focus, do something */
    .form-container textarea:focus {
    background-color: #ddd;
    outline: none;
    }
    /* Set a style for the submit/send button */
    .form-container .tombol {
    background-color: #4CAF50;
    color: white;
    padding: 10px 10px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom:10px;
    opacity: 0.8;
    }
    /* Add a red background color to the cancel button */
    .form-container .cancel {
    background-color: red;
    }
    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
    opacity: 1;
    }
    .display-right {
        display: flex;
        flex-direction: row-reverse;
    }
    .my-chat {
        background-color: #80F7FF;
        min-width:20px;
        border-radius: 15px 0px 15px 15px;
        padding: 0px 7px 3px 7px;
        margin: 0px 0px 7px 0px;
        box-shadow: 2px 2px 7px grey;
    }
    .display-left {
        display: flex;
        flex-direction: row;
    }
    .other-chat {
        background-color: #9FF1B6;
        min-width:20px;
        border-radius: 0px 15px 15px 15px;
        padding: 0px 7px 3px 7px;
        margin: 0px 0px 7px 0px;
        box-shadow: 2px 2px 7px grey;
    }
</style>

<template>
<div>
    <div id="chat-area">
        <div v-for="(message, index) in messages" :key="index" >
            <div v-if="message.user_id === user.id" class="text-right display-right">
                <div class="my-chat">
                    <span style="font-size:10px;">{{ moment(message.created_at).format('h:mm a')}}</span>
                    <strong style="font-size:11px;">{{message.user.name}} </strong>  <br>  
                    {{message.pesan}}
                </div>
            </div>
            <div v-else class="text-left display-left">
                <div class="other-chat">
                    <strong style="font-size:11px;">{{message.user.name}} </strong> 
                    <span style="font-size:10px;">{{ moment(message.created_at).format('h:mm a')}} </span><br> 
                    {{message.pesan}}
                </div>
            </div>
        </div>
    </div>
    <div id="kirim-pesan">
        <div class="input-group mb-3">
            <input type="text" id="isipesan" class="form-control" placeholder="Ketik pesan " aria-label="" aria-describedby="button-addon2" v-model="newMessage" name="pesan" @keyup.enter="sendMessage">
            <input type="hidden" id="user_id" v-bind:user_id="user.id">
            <input type="hidden" id="id_pertemuan" v-bind:id_pertemuan="id_pertemuan">
            <div class="input-group-append">
                <button class="btn btn-success" type="button" id="button-addon2" @click="sendMessage">Kirim</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment';
Vue.prototype.moment = moment;
export default {
    
    props: ['user','kelas_id','id_pertemuan','current_time'],

    data(){
        return {
            messages: [],
            newMessage: '',
            users:[],
            activeUser: false,
            typingTimer: false,

        }
    },
    created(){
        this.fetchMessages();
        
        Echo.join('chat')
        .here(user => {
            this.users = user;
        })
        .joining(user => {
            this.users.push(user);
        })
        .leaving(user => {
            this.users = this.users.filter(u => u.id != user.id);
        })
        .listen('ChatEvent',(event) => {
            this.messages.push(event.chat);
        })
        .listenForWhisper('typing', user => {
        this.activeUser = user;
            if(this.typingTimer) {
                clearTimeout(this.typingTimer);
            }
        this.typingTimer = setTimeout(() => {
            this.activeUser = false;
        }, 1000);
        })
        
        
    },
    methods: {
        fetchMessages(){
            axios.get(`../../../../../chat/${this.kelas_id}/${this.id_pertemuan}`).then(response => {
                this.messages = response.data;
                console.log(response.data);
                
            })
        },
        sendMessage(){
            this.messages.push({
                user: this.user,
                pesan: this.newMessage,
                created_at: this.current_time
                
            });
            
            
            axios.post(`../../../../../chat/${this.kelas_id}/${this.id_pertemuan}`,
                        {pesan: this.newMessage,
                        user_id: this.user.id,
                        pertemuan_id: this.id_pertemuan})
            
            //this.newMessage = ''
            // axios.post('messages', {message: this.newMessage});
            this.newMessage = '';
        },
        sendTypingEvent() {
            Echo.join('chat')
                .whisper('typing', this.user);
            console.log(this.user.name + ' is typing now')
        }
    }
}
</script>


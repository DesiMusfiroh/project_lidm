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
            console.log(this.users);
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

<style>

</style>

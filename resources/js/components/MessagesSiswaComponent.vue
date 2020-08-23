<template>
    <div id="chat-area">
        <div v-for="(message, index) in messages" :key="index" >
            <div v-if="message.user_id === message.user.id" class="text-right display-right">
                <div class="my-chat">
                    <span style="font-size:10px;">{{message.created_at}} </span>
                    <strong style="font-size:11px;">{{message.user.name}} </strong>  <br>  
                    {{message.pesan}}
                </div>
            </div>
            <div v-else class="text-left display-left">
                <div class="other-chat">
                    <strong style="font-size:11px;">{{message.user.name}} </strong> 
                    <span style="font-size:10px;">{{message.created_at}} </span><br> 
                    {{message.pesan}}
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" id="isipesan" class="form-control" placeholder="Ketik pesan " aria-label="" aria-describedby="button-addon2" v-model="newMessage" name="pesan">
            <input type="hidden" id="user_id" v-bind:user_id="user.id">
            <input type="hidden" id="id_pertemuan" v-bind:id_pertemuan="id_pertemuan">
            <div class="input-group-append">
                <button class="btn btn-success" type="button" id="button-addon2" @click="sendMessage">Kirim</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
    props: ['user','kelas_id','id_pertemuan'],

    data(){
        return {
            messages: [],
            newMessage: '',

        }
    },
    created(){
        this.fetchMessages();
        Echo.join('chatlidm')
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
            this.messages.push(event.chat_pertemuan);
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
            axios.get(`../../../pertemuan/chat/${this.kelas_id}/${this.id_pertemuan}`).then(response => {
                this.messages = response.data;
                console.log(response.data);
                
            })
        },
        sendMessage(){
            this.messages.push({
                user: this.user,
                pesan: this.newMessage
            });
            
            
            axios.post(`../../../pertemuan/chat/${this.kelas_id}/${this.id_pertemuan}`,
                        {pesan: this.newMessage,
                         user_id: this.user.id,
                         pertemuan_id: this.id_pertemuan}).then(response=>{
                console.log("oke");
                console.log(this.user.id);
                

            })
            
            //this.newMessage = ''
            // axios.post('messages', {message: this.newMessage});
            this.newMessage = '';
        }
    }
}
</script>

<style>

</style>
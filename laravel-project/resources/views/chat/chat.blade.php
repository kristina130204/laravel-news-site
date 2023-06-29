
    <div class="chat">
        @if (Auth::user())
        @if ((Auth::user()->banned))
            <div class="banned-chat">
                <span>You are banned from chat</span>
            </div>
        @endif
        <div class="chat-header">
            Chat with others
        </div>
        @else
            <div class="chat-header">
                Login to leave a message!
            </div>
        @endif 
        <div class="chat-body">
            <chat-messages :messages="messages"></chat-messages>
        </div>
        @if (Auth::user())
        <div class="chat-footer">
            <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
        </div>
        @endif
    </div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Room</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            direction: ltr;
        }

        .chat-container {
            display: flex;
            height: 100vh;
        }

        .messages {
            flex: 1;
            display: flex;
            flex-direction: column;
            border-left: 1px solid #ccc;
        }

        .message-list {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            background: #f2f2f2;
        }

        .message {
            margin-bottom: 10px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            max-width: 70%;
        }

        .message.you {
            background: #d1f0ff;
            align-self: flex-end;
        }

        .message-form {
            display: flex;
            border-top: 1px solid #ccc;
            padding: 10px;
        }

        .message-form input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
        }

        .message-form button {
            padding: 10px 15px;
            font-size: 16px;
            margin-left: 5px;
        }

        .user-list {
            width: 250px;
            background: #f9f9f9;
            border-right: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
        }

        .user {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
            position: relative;
        }

        .user span {
            font-size: 20px;
            margin-right: 8px;
        }

        .context-menu {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            display: none;
            z-index: 1000;
        }

        .context-menu button {
            padding: 8px 12px;
            width: 100%;
            border: none;
            background: white;
            text-align: left;
            cursor: pointer;
        }

        .private-chat {
            position: fixed;
            bottom: 10px;
            width: 300px;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 5px #ccc;
            display: flex;
            flex-direction: column;
            height: 300px;
            z-index: 2000;
        }

        .private-chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #007bff;
            color: white;
            font-weight: bold;
        }

        .private-chat-header button {
            background: transparent;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .private-chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            background: #f8f8f8;
        }

        .private-chat-input {
            display: flex;
            border-top: 1px solid #ccc;
            padding: 10px;
        }

        .private-chat-input input {
            flex: 1;
            padding: 8px;
        }

        .private-chat-input button {
            margin-left: 5px;
            padding: 8px;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <!-- Online Users -->
    <div class="user-list" id="users-list"></div>

    <!-- Public Chat -->
    <div class="messages">
        <div class="message-list" id="public-messages">
        </div>
        <input type="hidden" id="chatroom-id" value="{{ $chatRoom->id }}">
        <form class="message-form" onsubmit="sendPublicMessage(event)">
            <input type="text" id="public-message-input" placeholder="Type a message...">
            <button type="submit">Send</button>
        </form>
    </div>
</div>

<!-- Right-Click Menu -->
<div class="context-menu" id="context-menu">
    <button onclick="startPrivateChat()">Private Chat</button>
</div>

<!-- Container for All Private Chats -->
<div id="private-chats-container"></div>



<script src="{{ asset('build/assets/app-C7fJsBiM.js') }}"></script>
<script>
    let selectedUser = "";
    const contextMenu = document.getElementById("context-menu");
    const privateChats = {}; // Keep track of open chats
    const chatRoomId = document.getElementById('chatroom-id').value

    function openMenu(e, user) {
        e.preventDefault();
        selectedUser = user;
        contextMenu.style.top = e.pageY + "px";
        contextMenu.style.left = e.pageX + "px";
        contextMenu.style.display = "block";
    }

    window.addEventListener("click", () => {
        contextMenu.style.display = "none";
    });

    function startPrivateChat() {
        if (privateChats[selectedUser]) return; // already open

        const chatId = `chat-${selectedUser.replace(/\s+/g, '-')}`;

        const chatBox = document.createElement("div");
        chatBox.className = "private-chat";
        chatBox.id = chatId;
        chatBox.style.left = (Object.keys(privateChats).length * 310 + 10) + "px";

        chatBox.innerHTML = `
      <div class="private-chat-header">
        <span>Chat with ${selectedUser}</span>
        <button onclick="closePrivateChat('${chatId}', '${selectedUser}')">✖</button>
      </div>
      <div class="private-chat-messages" id="${chatId}-messages"></div>
      <div class="private-chat-input">
        <input type="text" id="${chatId}-input" placeholder="Type a message...">
        <button onclick="sendPrivateMessage('${chatId}')">Send</button>
      </div>
    `;

        document.getElementById("private-chats-container").appendChild(chatBox);
        privateChats[selectedUser] = chatId;
    }

    function closePrivateChat(chatId, user) {
        document.getElementById(chatId).remove();
        delete privateChats[user];
    }

    function sendPublicMessage(e) {
        e.preventDefault();
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const input = document.getElementById("public-message-input");
        const message = input.value.trim();

        if (message === "") return;

        let url = `{{ route('chat-room.public.message') }}`

        const form = new FormData()
        form.append('_token', '{{ csrf_token() }}')
        form.append('message', input.value)
        form.append('chatRoomId', chatRoomId)

        const response = fetch(url, {method: 'POST', body: form});

    }

    function sendPrivateMessage(chatId) {
        const input = document.getElementById(`${chatId}-input`);
        const message = input.value.trim();
        if (message === "") return;

        const list = document.getElementById(`${chatId}-messages`);
        const msg = document.createElement("div");
        msg.className = "message you";
        msg.innerText = message;
        list.appendChild(msg);
        input.value = "";
        list.scrollTop = list.scrollHeight;
    }

    document.addEventListener('DOMContentLoaded', (e) => {

        let chatChannel = 'chat-room.' + chatRoomId;
        let channel2 = window.Echo.join(chatChannel);

        channel2.listen('PublicMessageSent', (e) => {
            let c = window.location.href.split('/');

            if (e.chatRoomId == c[4]) {
                const list = document.getElementById("public-messages");
                const msg = document.createElement("div");
                msg.className = "message you";
                msg.innerText = `👤${e.firstName}: ${e.message}`;

                list.appendChild(msg);
                document.getElementById("public-message-input").value = "";
                list.scrollTop = list.scrollHeight;
            }
        });

        channel2.here(users => {
            let onlineUsersSection = document.getElementById('users-list');

            // Clear existing users
            onlineUsersSection.innerHTML = '';

            users.forEach((user) => {
                let userDiv = document.createElement('div');
                userDiv.classList.add('user');
                userDiv.oncontextmenu = function (event) {
                    openMenu(event, user.name); // You can also use user.id if needed
                    return false;
                };

                let emojiSpan = document.createElement('span');
                emojiSpan.textContent = '🤵🏻‍♂️';

                let nameDiv = document.createElement('div');
                nameDiv.textContent = user.name;

                // Create hidden input
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.value = user.id;

                userDiv.appendChild(emojiSpan);
                userDiv.appendChild(nameDiv);
                userDiv.appendChild(hiddenInput);

                onlineUsersSection.appendChild(userDiv);
            });
        });

        channel2.joining(user => {
            let onlineUsersSection = document.getElementById('users-list');

            if (onlineUsersSection.querySelector(`input[type="hidden"][value="${user.id}"]`)) {
                return;
            }

            let userDiv = document.createElement('div');
            userDiv.classList.add('user');
            userDiv.oncontextmenu = function (event) {
                openMenu(event, user.name);
                return false;
            };

            let emojiSpan = document.createElement('span');
            emojiSpan.textContent = '🤵🏻‍♂️';

            let nameDiv = document.createElement('div');
            nameDiv.textContent = user.name;

            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.value = user.id;

            userDiv.appendChild(emojiSpan);
            userDiv.appendChild(nameDiv);
            userDiv.appendChild(hiddenInput);

            onlineUsersSection.appendChild(userDiv);
        });

    }, chatRoomId);


</script>

</body>
</html>

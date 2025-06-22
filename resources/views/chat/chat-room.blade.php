<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Room List</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .room-list {
            list-style: none;
            padding: 0;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .room-list li {
            padding: 15px;
            margin-bottom: 10px;
            background: #f0f0f0;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .room-list li:hover {
            background: #e0e0e0;
        }

        .filter-btn {
            padding: 10px 15px;
            margin: 0 10px;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .filter-btn:hover {
            background-color: #0056b3;
        }

        .create-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Modal for Create Room */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 25px 20px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .modal-content h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .modal-content label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .select-type {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .modal-content input[type="text"],
        .modal-content input[type="password"],
        .modal-content input[type="number"] {
            width: 94%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .modal-content .checkbox {
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-content button {
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }

        .cancel-btn {
            background: #ccc;
            margin-top: 5px;
        }

        .save-btn {
            background: #28a745;
            color: white;
        }

        /* NEW: Modal for password prompt */
        .modal-password .modal-content {
            width: 300px;
        }

        .modal-password h3 {
            text-align: center;
            margin-top: 0;
        }
    </style>
</head>
<body>

<div>
    @if(session()->has('chat_room_created_successfully'))
        <div> {{ session()->get('chat_room_created_successfully') }} </div>
    @endif
</div>

<div class="container">
    <h1>Available Chat Rooms</h1>
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="filterRooms('public')" class="filter-btn">🔓 Public Rooms</button>
        <button onclick="filterRooms('private')" class="filter-btn">🔒 Private Rooms</button>
    </div>

    <ul class="room-list" id="room-list">
        @foreach($chatRooms as $chatRoom)
            <a href="{{ route('chat-room.enter', ['chatRoom' => $chatRoom->id]) }}">
                <li onclick="handleRoomClick(this)" data-private="{{ $chatRoom->status ? '1' : '0' }}">
                    <span>🔱 {{ $chatRoom->name }}</span>
                    <span>
                <span>{!! $chatRoom->limit ? "👤" . $chatRoom->limit . "/" . "<span id='current-online-users'></span>" : "" !!}</span>
                {{ !$chatRoom->password ? "🔓 Public" : "🔒 Private" }}
                </span>
                </li>
            </a>
        @endforeach
    </ul>

    <button class="create-btn" onclick="openModal()">➕ Create New Chat Room</button>
</div>

<!-- Modal for Create Room -->

<div class="modal" id="createModal">
    <div class="modal-content">
        <form method="POST" action="{{ route('chat-room.store') }}">
            @csrf
            <h2>Create Chat Room</h2>

            <label for="room-name">Chatroom Name</label>
            <input type="text" id="room-name" name="name" placeholder="Enter room name">

            <label for="room-type">Room Type</label>
            <select name="status" id="room-type" class="select-type">
                <option value="0">Public</option>
                <option value="1">Private</option>
            </select>

            <div class="checkbox">
                <input type="checkbox" id="need-password" onchange="togglePasswordInput()">
                <label for="need-password">Need password</label>
            </div>

            <div id="password-section" style="display: none;">
                <label for="room-password">Password</label>
                <input type="password" name="password" id="room-password" placeholder="Enter password">
            </div>

            <div class="checkbox">
                <input type="checkbox" id="need-limit" onchange="toggleLimitInput()">
                <label for="need-limit">Set limit</label>
            </div>

            <div id="limit-section" style="display: none;">
                <label for="room-limit">Max users</label>
                <input type="number" name="limit" id="room-limit" min="1" placeholder="e.g. 50">
            </div>

            <button class="save-btn">Create</button>
            <button class="cancel-btn" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>

<!-- NEW: Modal for password -->
<div class="modal modal-password" id="passwordModal">
    <div class="modal-content">
        <h3>Enter Room Password</h3>
        <input type="password" placeholder="Password">
        <button class="save-btn" onclick="closePasswordModal()">Enter</button>
        <button class="cancel-btn" onclick="closePasswordModal()">Cancel</button>
    </div>
</div>

<script>
    const modal = document.getElementById('createModal');
    const roomList = document.getElementById('room-list');
    const passwordModal = document.getElementById('passwordModal');

    document.addEventListener('DOMContentLoaded', function () {
        filterRooms();
    });

    function openModal() {
        modal.style.display = 'flex';
    }

    function closeModal() {
        modal.style.display = 'none';
        document.getElementById('room-name').value = '';
        document.getElementById('room-password').value = '';
        document.getElementById('room-limit').value = '';
        document.getElementById('need-password').checked = false;
        document.getElementById('need-limit').checked = false;
        document.getElementById('password-section').style.display = 'none';
        document.getElementById('limit-section').style.display = 'none';
    }

    function togglePasswordInput() {
        document.getElementById('password-section').style.display =
            document.getElementById('need-password').checked ? 'block' : 'none';

        if (document.getElementById('password-section').style.display === 'none') {
            document.getElementById('room-password').value = ''
            document.getElementById('room-limit').value = '';
        }
    }

    function toggleLimitInput() {
        document.getElementById('limit-section').style.display =
            document.getElementById('need-limit').checked ? 'block' : 'none';
    }

    // NEW: handle click on room
    function handleRoomClick(item) {
        const text = item.innerText;
        if (text.includes('🔒')) {
            passwordModal.style.display = 'flex';
        }
    }

    function closePasswordModal() {
        passwordModal.style.display = 'none';
    }

    function filterRooms(type = 'public') {
        const rooms = document.querySelectorAll('#room-list li');
        rooms.forEach(li => {
            const isPrivate = li.getAttribute('data-private') === '1';
            if (type === 'public') {
                console.log(1);

                li.style.display = isPrivate ? 'none' : 'flex';
            } else if (type === 'private') {
                li.style.display = isPrivate ? 'flex' : 'none';
            }
        });
    }

</script>

</body>
</html>

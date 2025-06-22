
let channel = window.Echo.private('user-registered');

channel.listen('UserRegistered', (e) => {

    const messagesDiv = document.getElementById('notification');

    if (messagesDiv) {
        const messageElement = document.createElement('p');

        const strongMessage = document.createElement('strong')

        strongMessage.setAttribute('style', 'color:red')

        strongMessage.textContent = `New user: ${e.newRegisteredUser.email}`

        messageElement.appendChild(strongMessage)

        messagesDiv.appendChild(messageElement);

        messagesDiv.setAttribute('style', 'display:block')
    }
});

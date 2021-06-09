import Echo from "laravel-echo"
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'cb071e8da9c0805e31e0',
    cluster: 'ap1',
    encrypted: true
});

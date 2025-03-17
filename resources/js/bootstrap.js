const {useToast} = require("vue-toast-notification");

window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//define axios Interceptor
window.axios.interceptors.request.use((config) => {
    const token = localStorage.getItem("token");
    if (token) config.headers.Authorization = `Bearer ${token}`;
    return config;
});

window.axios.interceptors.response.use(
    function (response) {
        // const $toast = useToast();
        // // Show a success toast
        // $toast.success(response.data, {
        //     position: 'top-right',
        //     duration: 5000, // Toast duration in milliseconds
        //     dismissible: true, // Allow users to manually dismiss the toast
        // });
        return response;
    },
    function (error) {
        const $toast = useToast();
        $toast.error(error.response.data, {
            position: 'bottom-right',
            duration: 5000, // Toast duration in milliseconds
            dismissible: true, // Allow users to manually dismiss the toast
        });
        if (error.response.status === 401) {
        }
        return Promise.reject(error);
    }
);
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

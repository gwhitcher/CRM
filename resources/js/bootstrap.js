window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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

/** jquery **/
try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

/* add row */
$(document).ready(function() {
    let int = 0;
    $(".addRow").click(function(e) {
        e.preventDefault();
        int++;
        let html = '';
        html += '<div class="row mb-2" id="line_item_new_row_' + int + '">';

        //top
        html += '<div class="col-sm-6 fst-italic">Line Item</div>'
        html += '<div class="col-sm-6 text-center text-md-end">';
        html += '<a href="#" data-id="' + int + '" class="deleteRowNew text-danger">';
        html += '<i class="fa-solid fa-circle-xmark"></i>';
        html += '</a>';
        html += '</div>';

        //title
        html += '<div class="col-sm-3">';
        html += '<label for="line_items[new_' + int + '][title]">Title</label>';
        html += '<input class="form-control" type="text" value="" name="line_items[new_' + int + '][title]" />';
        html += '</div>';

        //content
        html += '<div class="col-sm-3">';
        html += '<label for="line_items[new_' + int + '][content]">Content</label>';
        html += '<input class="form-control" type="text" value="" name="line_items[new_' + int + '][content]" />';
        html += '</div>';

        //quantity
        html += '<div class="col-sm-3">';
        html += '<label for="line_items[new_' + int + '][quantity]">Quantity</label>';
        html += '<input class="form-control" type="text" value="" name="line_items[new_' + int + '][quantity]" />';
        html += '</div>';

        //price
        html += '<div class="col-sm-3">';
        html += '<label for="line_items[new_' + int + '][price]">Price</label>';
        html += '<input class="form-control" type="text" value="" name="line_items[new_' + int + '][price]" />';
        html += '</div>';

        html += '</div>';

        $('#new_line_items').append(html);
    });
});

/* delete row */
$(document).ready(function() {
    $(".deleteRow").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $('#line_item_row_' + id).remove();
    });
});
$(document).on("click", ".deleteRowNew", function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $('#line_item_new_row_' + id).remove();
});

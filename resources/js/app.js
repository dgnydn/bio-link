window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$('.user-link').click(function(e) {
    axios.post('/visit/' + $(this).data('link-id'), {
            link: $(this).attr('href')
        })
        .then(response => console.log('response: ', response))
        .catch(error => console.error('error: ', error));
});
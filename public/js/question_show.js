/**
 * Simple (ugly) code to handle the comment vote up/down
 */
var $container = $('.js-vote-arrows');
alert('te');
$container.find('a').on('click', function(e) {
    e.preventDefault();
    var $link = $(e.currentTarget);

    alert('ewr');

    $.ajax({
        url: '/comments/10/vote/'+$link.data('direction'),
        method: 'POST'
    }).then(function(response) {
        $container.find('.js-vote-total').text(response.votes);
    });
});

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// importing jquery, since its no linked anymore but installed by yarn (yarn add jquery --dev)
import $ from 'jquery';


/**
 * Simple (ugly) code to handle the comment vote up/down
 */
var $container = $(".js-vote-arrows"); //['prevObject'][0];
console.log("First call of jquery-js file");
console.log("This is the container" + $container);

$container.find('a').on('click', function (e) {

    console.log("This is a function parameter: " + e);

    e.preventDefault();
    var $link = $(e.currentTarget);

    console.log("Well fuck me, inside function");
    console.log($link.data('direction'));

    $.ajax({
        url: '/comments/10/vote/' + $link.data('direction'),
        method: 'POST'
    }).then(function (response) {
        $container.find(".js-vote-total").text(response.vote);
    });
});

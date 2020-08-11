/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Index');

$(".form-delete").on("submit", function(){
    return confirm("Confirma exclusão?");
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){
    $("#search-tags-table").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tags-table-body tr td[data-search='1']").filter(function() {
            $($(this).parent()[0]).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#search-subjects-table").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#subjects-table-body tr td[data-search='1']").filter(function() {
            $($(this).parent()[0]).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#search-users-table").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#users-table-body tr td[data-search='1']").filter(function() {
            $($(this).parent()[0]).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

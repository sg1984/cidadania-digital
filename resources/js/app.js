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

$(function() {
    if ($('#tags').length > 0) {
        $('#tags').select2({
            tags: true,
            tokenSeparators: [',', ';'],
            createTag: function (params) {
                var term = $.trim(params.term).replace(/[0-9]/g, '');
                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                }
            },
        });
    }
});

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

$('#content-directory').carousel({
    interval: 10000
})

$('#wiki-cidadania').carousel({
    interval: 10000
})

$('.carousel .carousel-item').each(function(){
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }
});

$(function () {
    $('.modal-home-video').on('click', (event) => {
        $('#modal-video-title').empty();
        $('#modal-video iframe').attr('src', '');
        const $this = $(event.currentTarget);
        const videoTitle = $this.data('video-title');
        const videoUrl = $this.data('video-url');
        $('#modal-video-title').append(videoTitle);
        $('#modal-video iframe').attr('src', videoUrl);
        $('#modal-video').modal('show');
    })
})

$(function() {
    $( ".accordion-content" ).accordion({collapsible: true});
});

$(function() {
    handleClick = (videoId) => {
        $('#' + videoId).toggleClass('hidden');
    }
});

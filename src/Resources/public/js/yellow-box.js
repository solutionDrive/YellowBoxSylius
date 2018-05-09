$(document).ready(function () {
    $('#yellow-box .message.negative .icon.close').on('click', function (event) {
        $('#yellow-box .message.negative').addClass('hidden');
        event.stopPropagation();
    });

    $('#yellow-box').on('click', function(){
        toogleOverlay();
    });

    function showApproveModal(story) {
        $('.modal.accept').find('.story').html(story);
        $('.modal.accept').modal({
            onApprove : function() {
                console.log('approved ' + story + ' lol');
                approveStory(story);
            }
        }).modal('show');
    }

    function showDeclineModal(story) {
        $('.modal.decline').find('.story').html(story);
        $('.modal.decline').modal({
            onApprove : function() {
                console.log('declined ' + story + ' lol');
                declineStory(story);
            }
        }).modal('show');
    }

    function toogleOverlay() {
        $('#yellow-box').toggleClass('expanded');
        saveState();
        if ($('#storys').hasClass('hidden')) {
            setTimeout(function () {
                $('#storys').removeClass('hidden').addClass('animated');
            }, 600)
        } else {
            $('#storys').addClass('hidden').removeClass('animated');
        }
    }

    function approveStory(story) {
        showLoader();
        $.ajax({
            url: '/solutiondrive/yellowbox/approve',
            method: 'POST',
            data: {story: story}
        }).done(function (data) {
            console.log('ajax success');
            if (data.success === true) {
                reloadStorys();
            } else {
                //show error
            }
        }).fail(function (error) {
            console.log('ajax error');
            console.log(error);
            showError(error);
        }).always(function () {
            hideLoader();
            reloadStorys();
        });
    }

    function showError(error) {
        $('#yellow-box').find('.error').html(error.status + ' ' + error.statusText);
        $('#yellow-box').find('.negative.message').removeClass('hidden');
    }

    function showLoader() {
        $('.ui.modal .ui.dimmer').addClass('active');
    }

    function hideLoader() {
        $('.ui.modal .ui.dimmer').removeClass('active');
    }

    function declineStory(story) {
        var reason = $('#decline_reason').val().trim();
        console.log(reason);
        $.ajax({
            url: '/solutiondrive/yellowbox/decline',
            method: 'POST',
            data: {story: story, decline_reason: reason}
        }).done(function (data) {
            console.log('ajax success');
        }).fail(function (error) {
            console.log('ajax error');
            console.log(error);
            showError(error);
        }).always(function () {
            hideLoader();
            reloadStorys();
        });
    }

    function reloadStorys() {
        $('#yellow-box').find('#storys').html('');
        sync();
    }

    function saveState() {
        if ($('#yellow-box').hasClass('expanded')) {
            $.cookie('yellowbox-state', true, {path: "/"});
        } else {
            $.cookie('yellowbox-state', false, {path: "/"})
        }
    }

    function loadState() {
        if ($.cookie('yellowbox-state') === "true") {
            toogleOverlay();
        }
    }

    function sync() {
        $('#yellow-box').find('.ui.dimmer').addClass('active');

        $.ajax({
            url: '/solutiondrive/yellowbox/storys'
        }).done(function (data) {
            data.forEach(function(issue) {
                $('#yellow-box').find('#storys').append(
                    '        <div class="story ui grid">\n' +
                    '            <div class="story-name four wide column">'+ issue.key +'</div>\n' +
                    '            <div class="nine wide column">'+ issue.fields.summary +'</div>\n' +
                    '            <div class="two wide column">\n' +
                    '                <div class="ui icon tiny buttons">\n' +
                    '                    <div class="ui icon inverted button green accept">\n' +
                    '                        <i class="icon check"></i>\n' +
                    '                    </div>\n' +
                    '                    <div class="ui icon inverted button red decline">\n' +
                    '                        <i class="icon times"></i>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '        </div>'
                );
            });
        }).always(function () {
            $('#yellow-box .button.accept').on('click', function (event) {
                console.log('accept');
                showApproveModal($(this).parents('.story').find('.story-name').html().trim());
                event.stopPropagation();
            });

            $('#yellow-box .button.decline').on('click', function (event) {
                console.log('decline');
                showDeclineModal($(this).parents('.story').find('.story-name').html().trim());
                event.stopPropagation();
            });
            $('#yellow-box').find('.ui.dimmer').removeClass('active');
        });
    }

    sync();
    loadState();
});
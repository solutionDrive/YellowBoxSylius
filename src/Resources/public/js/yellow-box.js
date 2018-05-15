$(document).ready(function () {
    $('#yellow-box .message.negative .icon.close').on('click', function (event) {
        $('#yellow-box .message.negative').addClass('hidden');
        event.stopPropagation();
    });

    $('#yellow-box').on('click', function(){
        toogleOverlay();
    });

    function showApproveModal(story) {
        var modal = $('.modal.accept');
        modal.find('.story').html(story);
        modal.modal({
            onApprove : function() {
                approveStory(story);
            }
        }).modal('show');
    }

    function showDeclineModal(story) {
        var modal = $('.modal.decline');
        modal.find('.story').html(story);
        modal.modal({
            onApprove : function() {
                declineStory(story);
            }
        }).modal('show');
    }

    function toogleOverlay() {
        $('#yellow-box').toggleClass('expanded');
        saveState();
        var storysWrapper = $('#storys');
        if (storysWrapper.hasClass('hidden')) {
            setTimeout(function () {
                storysWrapper.removeClass('hidden').addClass('animated');
            }, 600)
        } else {
            storysWrapper.addClass('hidden').removeClass('animated');
        }
    }

    function approveStory(story) {
        requestStoryChange({
            url: '/solutiondrive/yellowbox/approve',
            method: 'POST',
            data: {story: story}
        });
    }

    function showError(error) {
        var yellowBox = $('#yellow-box');
        yellowBox.find('.error').html(error.status + ' ' + error.statusText);
        yellowBox.find('.negative.message').removeClass('hidden');
    }

    function showLoader() {
        $('.ui.modal .ui.dimmer').addClass('active');
    }

    function hideLoader() {
        $('.ui.modal .ui.dimmer').removeClass('active');
    }

    function declineStory(story) {
        var reason = $('#decline_reason').val().trim();
        requestStoryChange({
            url: '/solutiondrive/yellowbox/decline',
            method: 'POST',
            data: {story: story, decline_reason: reason}
        });
    }

    function reloadStorys() {
        clearStorys();
        loadStorys();
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

    function loadStorys() {
        startLoader();
        $.ajax({
            url: '/solutiondrive/yellowbox/storys'
        }).done(function (issues) {
            createIssuesDOM(issues);
            registerStoryListeners();
        }).always(function () {
            stopLoader();
        });
    }

    function clearStorys() {
        $('#yellow-box').find('#storys').html('');
    }

    function createIssuesDOM(issues)
    {
        issues.forEach(function(issue) {
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
    }

    function requestStoryChange(parameters) {
        $.ajax(parameters)
            .done(function (data) {
        }).fail(function (error) {
            showError(error);
        }).always(function () {
            hideLoader();
            reloadStorys();
        });
    }

    function registerStoryListeners() {
        $('#yellow-box .button.accept').on('click', function (event) {
            showApproveModal(getStoryKey(this));
            event.stopPropagation();
        });
        $('#yellow-box .button.decline').on('click', function (event) {
            showDeclineModal(getStoryKey(this));
            event.stopPropagation();
        });
    }

    function startLoader() {
        $('#yellow-box').find('.ui.dimmer').addClass('active');
    }

    function stopLoader() {
        $('#yellow-box').find('.ui.dimmer').removeClass('active');
    }

    function getStoryKey(currentNode)
    {
        return $(currentNode).parents('.story').find('.story-name').html().trim();
    }

    loadStorys();
    loadState();
});
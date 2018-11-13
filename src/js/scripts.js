$(document).ready(function(){
    /* Initializations for Materalize framework*/
    $('.sidenav').sidenav();
    $('input#projectName').characterCounter();
    $('select').formSelect();
    // tabs
    var elem = $('.tabs')
    var options = {
        swipeable: false
    }
    var instance = M.Tabs.init(elem, options);


    /**
     * The "Lire plus" functionality for the projects preview
     **/
    $('.ellipse-text').each(function() {
        let showCharacters = 100;
        let textEnd = " [...]";
        let readMore = '<span class="activator">Lire plus...</span>';

        let content = $(this).text(); // Retrieve the html content
        if (content.length > showCharacters) {
            let extractedText = content.substr(0, showCharacters);

            let preview = extractedText + textEnd;

            $(this).html(preview);
            $(this).next().html(readMore);
        }
    });

  });

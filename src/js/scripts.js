$(document).ready(function () {
    /* Initializations for Materalize framework*/
    $('.sidenav').sidenav();
    $('input#projectName').characterCounter();
    $('select').formSelect();
    // tabs
    var elem = $('.tabs')
    var options = {
        swipeable: false
    }
    M.Tabs.init(elem, options);
    $('.modal').modal();
    var elem = document.querySelector('.collapsible.expandable');
    var instance = M.Collapsible.init(elem, {
        accordion: false
    });


    /**
     * The "Lire plus" functionality for the projects preview
     **/
    $('.ellipse-text').each(function () {
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

    $('.datepicker').datepicker({
        firstDay: true,
        format: 'dd-mm-yyyy',
        i18n: {
            months: [ "janvier", "février", "mars", "avril", "mai", "juin",
            "juillet", "août", "septembre", "octobre", "novembre", "décembre" ],
            monthsShort: [ "janv.", "févr.", "mars", "avr.", "mai", "juin",
            "juil.", "août", "sept.", "oct.", "nov.", "déc." ],
            weekdays: [ "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi" ],
            weekdaysShort: [ "dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam." ],
            weekdaysAbbrev: [ "D","L","M","M","J","V","S" ]
        }
    });
});

function removeHelperText() {
    document.querySelector('#helper-text').innerHTML = '';
}

function verifyProjectName() {
    let confirmProjectName = document.querySelector('#confirmProjectName').value;
    let hiddenProjectName  = document.querySelector('#hiddenProjectName').value;
    let deleteProjectBtn = document.querySelector('#deleteProjectBtn');
    if (confirmProjectName.toLowerCase().localeCompare(hiddenProjectName.toLowerCase()) === 0) {
        deleteProjectBtn.disabled = false;
    }
    else {
        deleteProjectBtn.disabled = true;
    }
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = event.dataTransfer.getData("text");
    var dropTarget = event.target;

    // If the drop target is a child node of the progress column
    if (dropTarget.className.localeCompare('row box box-danger') != 0  ) {
        dropTarget = findAncestor(dropTarget);
    }
    dropTarget.appendChild(document.getElementById(data));

    document.querySelector('#sprintButtonAction').innerHTML = '<button type="submit" name="updateTaskSprintAndProgress" class="btn waves-effect waves-light yellow accent-4" style="color: black;">Enregistrer les modifications<i class="material-icons left" aria-hidden="true">save</i></button>';
}

function findAncestor (elem) {
    while ((elem = elem.parentElement) && elem.className.localeCompare('row box box-danger') != 0);
    return elem;
}

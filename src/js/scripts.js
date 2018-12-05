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
    $('.collapsible').collapsible();
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
        var dataType = 'progressColumn';
        dropTarget = findAncestorByDataType(dropTarget, dataType);
    }
    dropTarget.appendChild(document.getElementById(data));

    var idOldSprintArray = new Array();
    var idNewSprintArray = new Array();
    var idTaskArray = new Array();
    var progressArray = new Array();

    var idOldSprint = document.getElementById(data).getAttribute('data-sprint-id');
    var idNewSprint = findAncestorByDataType(dropTarget, 'sprint').getAttribute('data-sprint-id');
    var idTask = document.getElementById(data).getAttribute('data-task-id');
    var progress = dropTarget.getAttribute('data-column-progress');

    var idOldSprintArrayValue = document.querySelector("#sprintButtonAction form #idOldSprintArray").value;
    var idNewSprintArrayValue = document.querySelector("#sprintButtonAction form #idNewSprintArray").value;
    var idTaskArrayValue = document.querySelector("#sprintButtonAction form #idTaskArray").value;
    var progressArrayValue = document.querySelector("#sprintButtonAction form #progressArray").value;

    if (idOldSprintArrayValue !== "") {
        idOldSprintArray = idOldSprintArrayValue.split(',');
    }
    idOldSprintArray.unshift(idOldSprint);

    if (idNewSprintArrayValue !== "") {
        idNewSprintArray = idNewSprintArrayValue.split(',');
    }
    idNewSprintArray.unshift(idNewSprint);

    if (idTaskArrayValue !== "") {
        idTaskArray = idTaskArrayValue.split(',');
    }
    idTaskArray.unshift(idTask);

    if (progressArrayValue !== "") {
        progressArray = progressArrayValue.split(',');
    }
    progressArray.unshift(progress);

    console.log(idTaskArray);
    console.log(progressArray);
    console.log(idOldSprintArray);
    console.log(idNewSprintArray);

    document.querySelector("#sprintButtonAction form #idOldSprintArray").value = idOldSprintArray.toString();
    document.querySelector("#sprintButtonAction form #idNewSprintArray").value = idNewSprintArray.toString();
    document.querySelector("#sprintButtonAction form #idTaskArray").value = idTaskArray.toString();
    document.querySelector("#sprintButtonAction form #progressArray").value = progressArray.toString();


    // removeAllButLast(document.querySelector("#sprintButtonAction form #idTaskArray").value, idTaskArrayValue);

    document.querySelector("#sprintButtonAction #newSprint").style.display = 'none';
    document.querySelector("#sprintButtonAction form").removeAttribute("style");

    // Removing duplicates in the array. Keep the last task change
    removeDuplicates();
}

function findAncestorByDataType (elem, dataType) {
    while ((elem = elem.parentElement) && !(elem.hasAttribute('data-type') && elem.getAttribute('data-type').localeCompare(dataType) == 0));
    return elem;
}

function removeDuplicates() {
    var idOldSprintArray = document.querySelector("#sprintButtonAction form #idOldSprintArray").value.split(',');
    var idNewSprintArray = document.querySelector("#sprintButtonAction form #idNewSprintArray").value.split(',');
    var idTaskArray = document.querySelector("#sprintButtonAction form #idTaskArray").value.split(',');
    var progressArray = document.querySelector("#sprintButtonAction form #progressArray").value.split(',');

    for (var i = 0; i < idTaskArray.length; i++) {
        for (var j = i+1; j < idTaskArray.length; j++) {
            console.log('i = '+i+' ; j = '+j);
            if (idTaskArray[i] && idTaskArray[j] && idTaskArray[i].localeCompare(idTaskArray[j]) == 0) { // Old modification of the task
                console.log("A supprimer: "+progressArray[j]);
                idOldSprintArray[j] = '';
                idNewSprintArray[j] = '';
                idTaskArray[j] = '';
                progressArray[j] = '';
            }
        }
    }

    document.querySelector("#sprintButtonAction form #idOldSprintArray").value = idOldSprintArray.filter(checkEmptyValues).toString();
    document.querySelector("#sprintButtonAction form #idNewSprintArray").value = idNewSprintArray.filter(checkEmptyValues).toString();
    document.querySelector("#sprintButtonAction form #idTaskArray").value = idTaskArray.filter(checkEmptyValues).toString();
    document.querySelector("#sprintButtonAction form #progressArray").value = progressArray.filter(checkEmptyValues).toString();
}

function checkEmptyValues(val) {
    return val !== '';
}

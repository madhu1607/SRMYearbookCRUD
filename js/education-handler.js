$(document).ready(function() {
    eduEntryCounter = $('#hint_initial_edu_entries_count').val();
    maxEducationEntries = $('#hint_max_edu_entries').val();
});

function addEducationField() {
    if (eduEntryCounter < maxEducationEntries) {
        eduEntryCounter++;
        let form = $('#blck_education');

        let entryPosition = getEntryNumber(maxEducationEntries, '#blck_edu_year');
        form.append('<div id="blck_edu_year' + entryPosition + '"><p><label for="edt_edu_year' +
            entryPosition + '">Year:&nbsp;</label>' +
            '<input type="text" name="edu_year' + entryPosition +
            '" id="edt_edu_year' + entryPosition + '">' +
            '<input type="button" value="-" onclick="deleteEducationField(' +
            entryPosition + ');"></p></div>');
        form.append('<div id="blck_edu_school' + entryPosition + '"><p><label for="edt_edu_school' +
            entryPosition + '">School:&nbsp;</label>' +
            '<input type="text" name="edu_school' + entryPosition +
            '" id="edt_edu_school' + entryPosition + '"></p></div>');
    } else {
        alert('Maximum of education entries exceeded');
    }
}

function getEntryNumber(maxnum, id_desc_part) {
    for (let num = 1; num <= maxnum; num++) {
        let isExistingElement = $(id_desc_part + num).length;
        console.log(isExistingElement);
        if (!isExistingElement) {
            return num;
        }
    }
    return null;
}

function deleteEducationField(position) {
    eduEntryCounter--;
    $('#blck_edu_year' + position).remove();
    $('#blck_edu_school' + position).remove();
}

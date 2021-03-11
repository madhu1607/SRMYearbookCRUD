$(document).ready(function() {
    posEntryCounter = $('#hint_initial_pos_entries_count').val();
    maxPositionEntries = $('#hint_max_pos_entries').val();
});

function addPositionField() {
    if (posEntryCounter < maxPositionEntries) {
        posEntryCounter++;
        let form = $('#blck_positions');

        let entryPosition = getEntryNumber(maxPositionEntries, '#blck_pos_year');
        form.append('<div id="blck_pos_year' + entryPosition + '"><p><label for="edt_pos_year' +
            entryPosition + '">Year:&nbsp;</label>' +
            '<input type="text" name="pos_year' + entryPosition +
            '" id="edt_pos_year' + entryPosition + '">' +
            '<input type="button" value="-" onclick="deletePositionField(' +
            entryPosition + ');"></p></div>');
        form.append('<div id="blck_pos_desc' + entryPosition +
            '"><p><textarea name="pos_desc' + entryPosition +
            '" id="txt_pos_desc' + entryPosition +
            '" rows="8" cols="80"></textarea></p></div>');
    } else {
        alert('Maximum of position entries exceeded');
    }
}

function getEntryNumber(maxnum, id_base_part) {
    for (let num = 1; num <= maxnum; num++) {
        let isExistingElement = $(id_base_part + num).length;
        console.log(isExistingElement);
        if (!isExistingElement) {
            return num;
        }
    }
    return null;
}

function deletePositionField(position) {
    posEntryCounter--;
    $('#blck_pos_year' + position).remove();
    $('#blck_pos_desc' + position).remove();
}

// To load list of registers from database
function loadList(sort){
    $.get(`/xfuel/?sort=${sort}`,(response, status)=>{
        if (status === "success") {
            // console.log('success: ', response);
            createTable(response);
        }
        else {
          // console.log('erro: ', response.responseText);
            alert('Erro no servidor\nContate o administrador');
        }
    });
}

// To create table from server json
function createTable (data) {
    const tb = document.createElement("table");

    if (data.length > 0) {
        $.each(data, (i, item) => {
            let start     = new Date(item.DATE_START);
            let end    = new Date(item.PLANNED_END);
            let today     = new Date();

            let startTd   = hourToString(start.getHours(), start.getMinutes());
            let endTd     = hourToString(end.getHours(), end.getMinutes());

            startTd = (start.getDay() > today.getDay()) ? `<td>${startTd}+</td>` : `<td>${startTd}</td>`;
            endTd   = (end.getDay() > today.getDay()) ? `<td>${endTd}+</td>` : `<td>${endTd}</td>`;

            let tr = document.createElement("tr");

            $(tr).attr('value', item.ID);
            $(tr).append(`<td>${item.TYPE.toUpperCase()}</td>`);
            $(tr).append(`<td>${item.LOCATION.toUpperCase()}</td>`);
            $(tr).append(`<td>${item.XFUEL_VALUE} MIN</td>`);
            $(tr).append(`<td>${item.REASON.toUpperCase()}</td>`);
            $(tr).append(startTd);
            $(tr).append(endTd);
            $(tb).append(tr);
        });
    }else{
        let tr = '<tr>'
        for (i=0; i<6; i++){
            var td = td + '<td></td>';
        }
        tr = tr + td + '</tr>'
        $(tb).append(tr);
    }

    $(tb).attr('id', 'table');
    $('#table-body').empty();
    $('#table-body').append(tb);
}

// Insert status msg
function msg(text){$('#status-msg').text(text);}

// To filter list from regions
$('.switch').click((e) => {
    loadList(e.target.id);
    $('.on').removeClass('on');
    $(e.target).addClass('on')
});

// To open form
$('.new-icon').click(()=>{$('#placeholder-form').removeClass('hidden').load('insert-form.php');});

// Select or deselect table row
$('#table-body').click((e)=>{
    $('tr').removeClass('selected');
    if (e.target.localName === 'td') {
        $(e.target.parentNode).addClass('selected');
    }
});

// Clear status msg
$('main').click(()=>{msg(null)});

// On ready: load list
$(document).ready(()=>{loadList('all');});




$(function() {
    $('#atom1').click(function() {
        $.get('/fusion/grid/update', function(response) {
            var rows = $.parseJSON(response);

            var tbody = '';

            for (var i = 0; i < rows.length; i++) {
                tbody += '<tr>';
                tbody += '<td>'+rows[i][0]+'</td>'
                tbody += '<td>'+rows[i][1]+'</td>'
                tbody += '</tr>';
            }

            $('#table tbody').html(tbody);
        });
    });

    $('#atom2').click(function() {
        $.get('/fusion/grid/update', {page: 1}, function(response) {
            var rows = $.parseJSON(response);

            var tbody = '';

            for (var i = 0; i < rows.length; i++) {
                tbody += '<tr>';
                tbody += '<td>'+rows[i][0]+'</td>'
                tbody += '<td>'+rows[i][1]+'</td>'
                tbody += '</tr>';
            }

            $('#table tbody').html(tbody);
        });
    });
});
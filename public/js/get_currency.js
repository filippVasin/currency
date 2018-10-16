$(document).ready(function(){

    $('#contactform').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: '/get_currencies',
            success: function(data){
                var obj = $.parseJSON(data);
                console.log(obj);
            }
        })
    });

    var conn = new ab.Session('ws://localhost:8080',
        function() {
            conn.subscribe('currency_list', function(topic, data) {
                console.info('New Data: topic_id "'+ topic +'"');
                console.log(data.data);
                var obj = $.parseJSON(data.data);
                $("#currency_table").html("");
                $.each(obj, function(i, val) {
                    var row =  '<tr><td>' + val['name'] + '</td>' + '<td>' + val['volume'] + '</td>' + '<td>' + val['amount'] + '</td></tr>';
                    $("#currency_table").append(row);
                });
            });
        },
        function(code, reason, dateil) {
            console.warn('WebSocket connection closed '+ code + ' ' + reason + ' ' + dateil);
        },
        {'skipSubprotocolCheck': true}
    );
});
// Event Section
$(document).on("click", ".change-type", function(event){
    event.preventDefault();
    elem = $(this);
    bootbox.confirm("Change engine type?", function(result){
        if(result == true){
            var ids = new Array();
            var cid = elem.parent().parent().find("td:eq(1)").text();
            var url = elem.attr("url-api");
            ids[0] = cid;
            request = $.ajaxq("queue", {
                "url":url,
                "type":"POST",
                "data": $.param({id: ids}),
                "dataType":"json"
            });
            request.done(function(json){
                if(json.success){
                    oTable.draw();
                }
                $.gritter.add({title: json.title, text: json.messages}); 
            });
            request.fail(function(jqXHR, textStatus){
                $.gritter.add({title: "Request failed", text: textStatus}); 
            });
        }
    }); 
    return false;
});
// Ready Section Datatable
$(document).ready(function(){
    $(".fancybox").fancybox();
    $("#page-container").addClass("page-sidebar-minified");
    $('#example tfoot th').each( function(){
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="'+title+'" style="width:100%" />' );
    });
    oTable = $("#example").DataTable({
        "sorting":[[8, "desc"]], 
        "displayLength": 10,
        "processing": true,
        "serverSide": true,
        "serverMethod": "POST",
        "ajax":base_url+"/clippers/load_data",
        "columns": [
            {"data": "select", "searchable":false, "sortable":false},
            {"data": "clipper_id"},
            // {"data": "thumbnail", "searchable":false, "sortable":false},
            {"data": "clipper_media"},
            {"data": "clipper_category"},
            {"data": "clipper_base_url"},
            // {"data": "language"},
            // {"data": "server"},
            {"data": "engine_status"},
            {"data": "engine_type"},
            {"data": "deployed"},
            {"data": "clipper_last_update"},
            {"data": "class_id"},
            {"data": "action", "searchable":false, "sortable":false}
        ]
    });
    for(i = 250; i <= 8000; i++){
        $("select[name=\"example_length\"]").append("<option value=\""+ i +"\">"+ i +"</option>");
        i = (i * 2)-1;
    }
}); 


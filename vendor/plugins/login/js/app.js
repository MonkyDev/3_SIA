function LoadDataTable(id){
	$('#'+id).DataTable( {
        "language": {
            "url": "bower_components/datatables.net/Spanish.json"
        }
    } );
}

function LoadDataTableMod(id,op){
	var mods=op.split("|");

	$('#'+id).DataTable( {
		"language": {
			"url": "bower_components/datatables.net/Spanish.json"
		},
	    'paging'      : +mods[0],
	    'lengthChange': +mods[1],
	    'searching'   : +mods[2],
	    'ordering'    : +mods[3],
	    'info'        : +mods[4],
	    'autoWidth'   : +mods[5]
	});
}
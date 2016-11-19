$(document).ready(function(){
	$('#search').keyup(function(){
		var search = $(this).val();
		search = $.trim(search);
		if(search !=="") {
			$('#loader').show();
			$.ajax( 'recherchealiment.php'
				, { type : 'POST'
				    , data : { search : search }
				    , success : function(data) { $('#resultat').html(data); }
				}
			);
			$('#loader').hide();
		}
	});
});

alert("Attention !! N'oubliez pas de saisir vos boissons, vos en-cas, <br>
		   		les sucreries, les confiseries, les matières grasses (huiles, margarines, beurres...)<br>
		    	et le sel (même s il faut le peser !)");
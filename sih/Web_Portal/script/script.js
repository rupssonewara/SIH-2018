$(document).ready(function(){

	$("#myModal").on("hidden.bs.modal", function() {
    $(".container").show();
    $(".ml_recom").hide();
    $(".modal-title").html("Description");
  });

    $("#recom").click(function(){
    	$(".container").slideToggle();
        $(".ml_recom").slideToggle("slow");
        $(".modal-title").html("Recommendations");
    });

	/*LOGIN*/
	$("#login").on("hidden.bs.modal", function() {
    $(".log").show();
	$(".register").hide();
    $(".modal-title").html("LOGIN");
  });

    $("#registerbtn").click(function(){
		$(".container").slideToggle();
        
        $(".register").slideToggle("slow");
        $(".modal-title").html("Register here");
		$(".log").hide();
    });

    $('#myModal').on('show.bs.modal', function(e) {
        var id = e.relatedTarget.dataset.id;
        var idNum = parseInt(id);
        // Do some stuff w/ it.
        document.getElementById("myLink").innerHTML= idNum;
        return idNum;
    });

    /* SEARCH */
        $("#search").click(function(){
            var input = document.getElementById('myInput');
            var title = document.getElementById('title');
            
            console.log(input);
            console.log(title);
            // if(title == input)
                $(".sidenav").html("Success");
    });


        (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
        

        /* ANALYSIS */

        $("#analysis").click(function(){
                window.location.href = "http://hosting619.96.lt/sih/Web_Portal/item1_analysis.html";
    });
});

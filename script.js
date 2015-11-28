$(document).ready(function(){

	

$('#areas')
    .after("<span></span>")
    .next()
    .hide()
    .end()
    .keypress(function(e) {
      var current = $(this).val().length;
      if(current >= 400) {
        if(e.which != 0 && e.which != 8) {
          e.preventDefault();
        }
      }
      $(this).next().show().text(400 - current);
    });
    
  $('input.clear').each(function() {
    $(this)
      .data('default', $(this).val())
      .addClass('inactive')
      .focus(function() {
        $(this).removeClass('inactive');
        if($(this).val() == $(this).data('default') || '') {
          $(this).val('');
        }
      })
      .blur(function() {
        var default_val = $(this).data('default');
        if($(this).val() == '') {
          $(this).addClass('inactive');
          $(this).val($(this).data('default'));
        }
      });
  });



  $("#Comentario")
  .focus(function() {
        if (this.value === 'Ingresar Comentario') {
            this.value = '';
        }
  })
  .blur(function() {
        if (this.value === '') {
            this.value = 'Ingresar Comentario';
        }
});

  $('#menu li ul').css({
	    display: "none",
	    left: "auto"
	  });
	  $('#menu li').hoverIntent(function() {
	    $(this)
	      .find('ul')
	      .stop(true, true)
	      .slideDown('fast');
	  }, function() {
	    $(this)
	      .find('ul')
	      .stop(true,true)
	      .fadeOut('fast');
	  });

$('a[href=#]').click(function() {
	$.scrollTo(0,'slow');
	return false;
});



$("a.vote_up").click(function(){
 //get the id
 the_id = $(this).attr('id');
 usuario = $('#logueousuario').attr('class');
 
 $("p#votes_count"+the_id).fadeOut("fast");
 
 //the main ajax request
  $.ajax({
   type: "POST",
   data: "action=vote_up&id="+$(this).attr("id")+"&usuario="+usuario,
   url: "votos.php",
   success: function(msg)
   {
   $("p#votes_count"+the_id).html(msg);
    //fadein the vote count
    $("p#votes_count"+the_id).fadeIn();
    //remove the spinner
    $("span#vote_buttons"+the_id).remove();
   }
  });
 });


$("a.vote_down").click(function(){
 //get the id
 the_id = $(this).attr('id');
 usuario = $('#logueousuario').attr('class');
 // show the spinner
 $(this).parent().html("<img src='spinner.gif'/>");
 
 //fadeout the vote-count 
 $("p#votes_count"+the_id).fadeOut("fast");
 
 //the main ajax request
  $.ajax({
   type: "POST",
   data: "action=vote_up&id="+$(this).attr("id")+"&usuario="+usuario,
   url: "votos.php",
   success: function(msg)
   {
   $("p#votes_count"+the_id).html(msg);
    //fadein the vote count
    $("p#votes_count"+the_id).fadeIn();
    //remove the spinner
    $("span#vote_buttons"+the_id).remove();
   }
  });
 });







  
  
});



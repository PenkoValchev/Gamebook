   $.ajax('ajax/ajax_home.php')
   .done(function(data){
        $(".content_table").html(data);
    });

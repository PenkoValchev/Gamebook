  $.ajax('ajax/ajax_authors.php')
    .done(function(data){
        $(".content_table").html(data);
      
    });

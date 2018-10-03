function fun_edit(id)
    {
      var view_url = $("#hidden_view").val();
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#edit_id").val(result.id);
          $("#edit_first_name").val(result.first_name);
          $("#edit_last_name").val(result.last_name);
          $("#edit_email").val(result.email);
        }
      });
    }
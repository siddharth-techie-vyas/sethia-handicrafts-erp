var loading_img='../../images/loading.gif';

function get_details(inputid,outputid,url)
{
// alert(outputid);
  $('#'+outputid).html('');
  var id=$('#'+inputid).val();
  $.ajax({
           type: "POST",
           url: url+id,
           success: function(data)
           {
            // alert(url+id);
               $('#msg'+outputid).html("Please Wait !!!");
               $('#'+outputid).html(data);
               $('#msg'+outputid).html("")
              
           }
        });

}


//-- show model
function show_page_model(title,page)
{
  //alert(base_url+page);
  $('#modal-title').html(title); 
  //alert(page);
  $('#modal-body').html('<img src='+loading_img+'>');
  $('#modal-body').load(page); 
}

function show_page_model_big(title,page)
{
  //alert(base_url+page);
  $('#modal-title1').html(title); 
  //alert(page);
  $('#modal-body1').html('<img src='+loading_img+'>');
  $('#modal-body1').load(page); 
}


function form_submit(x) 
{
 
 //alert(x);
 var form = $("#"+x);
 //alert(form.serialize);
        $('#msg'+x).html("Please Wait !");
        form.hide();
        $.ajax({
           type: "POST",
           url: $("#"+x).attr("action"),
           data: form.serialize(),
           success: function(result)
           {
               $('#msg'+x).html(result);  
                form.reset();
           }
        }); 
        //form.show(); 
 } 


 
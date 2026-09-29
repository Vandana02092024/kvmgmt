// tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

    // toggle side-bar
    $('#toggle-side-bar').click(function(){
         $('.side-bar').toggleClass('open');
         $('.main-content').toggleClass('main-content-full');
         // $('body').toggleClass('overlay-black');
    });

    // auto-suggestion
    $('.auto-suggest-input input').click(function(){
      $('.suggestion-box').show();
    });
    
    
});

// upload file
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.adon-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
              // $('#file-name').text(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});


function addCommas(nStr)
{
  if(nStr < 0){
    nStr += '';
    ng    = nStr.split('-');
    nStr  = ng[1];
    ng    = '-';
  }else{
    nStr += '';
    ng  = '';
  }

  x  = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  // alert("hello");

  var num  = x1.replace(/,/gi, "");
  var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");

  return ng + num2 + x2;
}
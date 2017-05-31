$(document).ready(function () {
  jQuery.browser = {};
  (function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
      jQuery.browser.msie = true;
      jQuery.browser.version = RegExp.$1;
    }
  })();

  $(".mask-phone").inputmask({
    mask: ["(99) 9999-9999","(99) 99999-9999"],
    keepStatic: true
  });

  $(".select2").select2();
})

$(document).on('show.bs.modal','#modal-confirm', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var href = button.data('href') // Extract info from data-* attributes
  console.log(href);
  var modal = $(this)
  
  if(button.data('title')){
    modal.find('.modal-title').text(button.data('title'))
  }
  modal.find('.modal-body p').text(button.data('message'))
    
  modal.find('.modal-footer #confirm-link').attr('href',href)
})

$(document).on('click','#add-phone',function(){
  var empty = false;
  $('.mask-phone').each(function(){
    if(!$(this).val()){
      empty = true;
      return false;
    }
  })
  if(empty){
    return showAlertGeneral('error','Ainda existem campos vazios');
  }
  $('#group-add-phone').before('<div class="form-group form-phone-plus">' +
                                  '<label class="control-label col-sm-3"></label>' +
                                  '<div class="col-sm-9">' +
                                    '<input type="text" id="phone" name="phones[]" class="mask-phone form-control">' +
                                    '<span class="help-block error"></span>' +
                                  '</div>' +
                                '</div>')
  $(".mask-phone").inputmask({
    mask: ["(99) 9999-9999", "(99) 99999-9999"],
    keepStatic: true
  });
})

$(document).on('submit',function(){
  $('.mask-phone').unmask();
})



// FUNCOES ----------------------------------------------------------------------------------------------
function showAlertGeneral(status, message, obj, fixed, buttonClose) {
  var buttonClose = buttonClose ? buttonClose : 'Fechar';
  if (!obj) {
    obj = "#alert-general";
  }
  if (fixed) {
    $(obj).removeClass('alert-success').removeClass('alert-info')
            .removeClass('alert-danger').addClass('alert-' + status + ' alert-dismissible')
            .html('<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">' + buttonClose + '</span></button><p>' + message + '</p>')
            .slideDown(500);
  } else {
    $(obj).removeClass('alert-success').removeClass('alert-info')
            .removeClass('alert-danger').addClass('alert-' + status)
            .html('<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">' + buttonClose + '</span></button><p>' + message + '</p>')
            .slideDown(500).delay(5000).slideUp(500);
  }
}
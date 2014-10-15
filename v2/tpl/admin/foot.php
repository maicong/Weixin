<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}?>

</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<script>$('#mpwx').height(window.outerHeight);</script>
<script>
$(function(){
    $('#check-all').parent().addClass("hide");
    $("#check-all-btn").click(function() {
        if ($('#check-all').is(":checked")) {  
            $(".del-id").each(function() {  
                $(this).attr("checked", false);
                $(this).parent().removeClass("checked").attr("aria-checked","false");
            });  
        } else {  
            $(".del-id").each(function() {  
                $(this).attr("checked", true);
                $(this).parent().addClass("checked").attr("aria-checked","true");  
            });  
        }  
    }); 
    $('#select-type label').click(function(){
        var id = $(this).find('input').attr('id');
        $('#for-'+id).removeClass('hide').siblings('.for-rtype').addClass('hide');
        console.log(id);
    });
    $('#newline').click(function(){
        if($('.has-success').length>=5){
            $(this).remove();
            return false;
        }
        $('#for-rtype2').after($('#new-type-line').html());
    });
});
</script>
</body>
</html>
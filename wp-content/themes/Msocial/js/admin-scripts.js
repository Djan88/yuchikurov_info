jQuery(document).ready(function() {
    
    jQuery('#select-db').change(function(){
        
        var db = jQuery(this).val();
        
        jQuery.post( "/wp-admin/admin-ajax.php", { action: "select_master", db: db }, function(response){
              jQuery('#select-master').empty().html(response);            
        });
        
    });
    
    jQuery('#select-master').change(function(){
        
        var id = jQuery(this).val();
        
        var db = jQuery('#select-db').val();
        
        jQuery.post( "/wp-admin/admin-ajax.php", { action: "change_master", id: id, db: db }, function(response){
              
            
            var name = response.name.split(' ');
            
            jQuery('#master-id').val(response.id);
            jQuery('#name').val(name[1]);
            jQuery('#last-name').val(name[0]);
            jQuery('#midle-name').val(name[2]); 
            if(response.info){
                jQuery('#option').val(response.info);
            } else {
                jQuery('#option').val(response.options);
            }
            jQuery('#email').val(response.email);
            jQuery('#phone').val(response.phone);
            jQuery('#skype').val(response.skype);
            jQuery('#www').val(response.www);
            jQuery('#vkontakte').val(response.vkontakte);
            jQuery('#facebook').val(response.facebook);
            jQuery('#select-country').val(response.country);
            jQuery('#select-state').val(response.state);
            jQuery('#master-submit').val('Обновить');
     
        }, 'json');
        
    });
    
    jQuery('.status-pledge').on('change', function(){
        var status = jQuery(this).val();
        var id = jQuery(this).attr('id');

        jQuery.post( "/wp-admin/admin-ajax.php", { action: "status_pledge", status: status, id: id }, function(response){
                          
        });
    });
    
    jQuery('#delivery-select').change(function(){
        
        var select = jQuery(this).val();
        
        jQuery.post( "/wp-admin/admin-ajax.php", { action: "get_user_delivery", select: select }, function(response){
              jQuery('.delivery-type').empty().html(response);            
        });
        
    });
    
    jQuery('#add-row').click(function(){
        
        jQuery('.add-row-block').css("display","block");
        
    });
    
    jQuery('#add-master-select').change(function(){
        
        var id = jQuery(this).val();
        
        jQuery.post( "/wp-admin/admin-ajax.php", { action: "author_seminars", id: id }, function(response){
              jQuery('#add-seminar-select').empty().html(response);            
        });
        
    });
    
    jQuery('#select-options-reception-days').on('change', function(){
         var id = jQuery(this).val(); 
         jQuery('#'+id).css('display', 'block');
    });
    
    jQuery('.monthly').datepicker({
        dateFormat : 'yy-mm-dd'
    });
    
}); 



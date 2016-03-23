jQuery(document).ready(function($) { 
    jQuery('.input-group input[required], .input-group input:file[required], .input-group textarea[required], .input-group select[required]').on('keyup change', function() { 
        var $form = $(this).closest('form'), $group = $(this).closest('.input-group'), $addon = $group.find('.input-group-addon'), $icon = $addon.find('span'), state = false; 
        if (!$group.data('validate')) { 
            state = $(this).val() ? true : false; 
        }
        else if ($group.data('validate') == "email") { 
            state = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($(this).val()) 
        }
        else if($group.data('validate') == 'phone') { 
            state = /^[(]{0,1}[0-9]{2}[)]{0,1}[-\s\.]{0,1}[0-9]{2}[-\s\.]{0,1}[0-9]{2}[-\s\.]{0,1}[0-9]{2}$/.test($(this).val()) 
        }
        else if($group.data('validate') == 'number') { 
            state = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/.test($(this).val()) 
        }  
        else if($group.data('validate') == 'file') { 
            state = /^.*\.(jpg|JPG||png|PNG|jpeg|JPEG)$/.test($(this).val())
            //state = true;
        }              
        else if ($group.data('validate') == "length") { 
            state = $(this).val().length >= $group.data('length') ? true : false; 
        }
        if (state) { 
            $addon.removeClass('danger'); $addon.addClass('success'); $icon.attr('class', 'glyphicon glyphicon-ok'); 
        }
        else{ 
            $addon.removeClass('success'); 
            $addon.addClass('danger'); 
            $icon.attr('class', 'glyphicon glyphicon-remove'); 
        } 
        if ($form.find('.input-group-addon.danger').length == 0) { 
            $form.find('[type="submit"]').prop('disabled', false); 
        }
        else{ 
            $form.find('[type="submit"]').prop('disabled', true); 
        } 
    }); 
$('.input-group input[required], .input-group textarea[required], .input-group select[required], .input-group input:file[required]').trigger('change'); 
});




// jQuery("document").ready(function($){
    
//     $("#dc_camp_logo").change(function() {
//                 alert('changed!');
//             });

    
// });
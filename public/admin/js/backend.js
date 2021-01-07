/*global , $ , confirm ,FormData*/
$(function(){
"use strict";
    /*Start Global Function*/
    /*Success And Error In Ajax*/
    function success(deleteElm,action){
        deleteElm.parents('.full-article').remove();
        $('body').prepend('<div class="alert alert-success ajax-response">تم '+action+' بنجاح</div>');
        $('.ajax-response').delay(2000).animate({
            opacity:0
        },1000,function(){
            $(this).remove(); 
        });
    }
    function error(){
        $('body').prepend('<div class="alert alert-danger ajax-response">حدث شئ خطأ</div>');
        $('.ajax-response').delay(2000).animate({
            opacity:0
        },1000,function(){
            $(this).remove(); 
        });
    }
    /*Function To Delete Img With Ajax*/
    function deleteImage(file_name,artcID)
    {
        $.ajax({
            url : 'http://acaweb.com:81/admin/articles/?Delete&artcid='+artcID,
            data: {
                "imgs": file_name,
                "artcID":artcID
                },
                type: 'POST',
                dataType: 'text',
                success: function (data){
                    data == 'تم' ? success($(this),'الحذف') : error()
                },
        });
    }          
//    Delet Image Function
    $('.delete-img').on('click',function(){
        var r = confirm("هل أنت متأكد من حذف الصوره؟");
        if(r == true){
            $(this).parents('.full-article').remove();
            deleteImage($(this).data('id'),$(this).data('artc-id'));   
        }
    });
//Edit Article With Ajax
    $('.edit-article-form').on('submit',function(e){
        e.preventDefault();
        var catg    = $('[name=catg]').val(),
            title   = $('[name=title]').val(),
            details = $('[name=details]').val(),
            id      = $('.edit-article').data('artc-id');
        var formImgs = new FormData($(this)[0]);
        formImgs.append('artcID',id);
        formImgs.append('catg',catg);
        formImgs.append('title',title);
        formImgs.append('details',details);
        // Attach file
        $.ajax({
            url: 'http://acaweb.com:81/admin/articles/?Edit&artcid='+id,
            type: 'POST',
            data:formImgs,
            cache: false,
            processData: false,
            contentType: false,
            success:function(data){
                data == 'التعديل' ? success($(this),data) : error();
            }
        });
    });
	//Make Placeholder hide and shoe
	$('[placeholder]').focus(function(){
		$(this).attr('data-text',$(this).attr('placeholder'));
		$(this).attr('placeholder','');
	}).blur(function(){
		$(this).attr('placeholder',$(this).attr('data-text'))
	});
    //Add Value Of Input File To Span
    $('.images-article .images').on('change',function(){
        $(this).prev('span').text($(this).val()); 
    });
    //Ajax Request
    $('.delete').on('click',function(){
        var cnfrm = confirm('هل أنت متأكد من الحذف');
        var artcSelected = $(this);
        if(cnfrm == true){
            $.ajax({
                url : 'http://acaweb.com:81/admin/articles/',
                data: {
                    "artcID":artcSelected.data('id')
                },
                type: 'POST',
                dataType: 'text',
                success: success($(this),'المقاله'),
                error:error()
            });   
        }else{
            return false;
        }
	});
});
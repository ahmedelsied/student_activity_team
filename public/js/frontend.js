/*global ,$,window,jQuery*/
$(function(){
"use strict";
var nav = $('nav'),
scrollbtn = $('.scroll-to-top');
$('.catg_artc_title').text($('nav ul li a.main-color').text());
if(jQuery.isReady){
    $('.lds-ring').remove();
}
function navBack(){
    if(nav.offset().top > 70){
        nav.css('background-color','white');
    }else{
        nav.css('background-color','transparent')
    }
}
navBack();
//Live Ad Preview
$(window).on('scroll',function(){
    navBack();
    if($(this).scrollTop() >= 500){
        scrollbtn.fadeIn();
    }else{
        scrollbtn.fadeOut();
    }
});
scrollbtn.on('click',function(){
    $('html,body').animate({scrollTop:0},600); 
});
$('.form-contact').on('submit',function(e){
    e.preventDefault();
    var email = $(this).children('[name=contact-email]').val();
    $.ajax({
        url:'http://acaweb.com:81/main/subscribers',
        type:'post',
        data:{
            "email":email
        },
        dataType:'text',
        success:function(data){
            $('body').prepend(data);
            $('[name=contact-email]').val('');
            $('.suc-msg').delay(2000).animate({
                'opacity':0
            },2000,function(){
                $('.suc-msg').remove();
            });
        }
    });
});
$('.talent-form').on('submit',function(e){
    e.preventDefault();
    var form = $(this),
    name = form.children('[name=name]').val(),
    phone = form.children('[name=phone]').val(),
    talent = form.children('[name=talent]').val();
    $.ajax({
        url:'http://acaweb.com:81/main/participants',
        type:'post',
        data:{
            "name": name,
            "phone":phone,
            "talent":talent
        },
        dataType:'text',
        success:function(data){
            $('body').prepend(data);
            form.children('input').val('');
            $('.suc-msg').delay(2000).fadeOut();
        }
    });
});
});
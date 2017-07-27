$(function(){
    $('#118555 ul').slick({
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2500,
        slidesToShow: 1,
        prevArrow: $("#118555 .jcarousel-control-prev"),
        nextArrow: $("#118555 .jcarousel-control-next"),
    });
    $(".dropdown-toggle").on("click", function(){
        if($(window).width() > 991) {
            if(!$(this).parent().hasClass("ac"))
                $(this).parent().addClass("ac")
            else
                $(this).parent().removeClass("ac")

            return false;
        }
    })
    $(".alex_btn_feedback").on("click", function(){
        popupShow($(".popup_feedback"), $(".transparent"));
        return false;
    })
    $(".alex_btn_calc").on("click", function(){
        popupShow($(".popup_calc"), $(".transparent"));
        return false;
    })
    $(".transparent").on("click", function(){
        popupHide($(".popup"), $(".transparent"));
    })
    $(".popup_calc select + input").keydown(function(event) {
        // Разрешаем нажатие клавиш backspace, Del, Tab и Esc
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
             // Разрешаем выделение: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
             // Разрешаем клавиши навигации: Home, End, Left, Right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 return;
        }
        else {
            // Запрещаем всё, кроме клавиш цифр на основной клавиатуре, а также Num-клавиатуре
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }  
        }
    });
    $(".popup_calc form").submit(function(){
        var form = $(this),
            price = form.find("select option:selected").attr("value"),
            km = form.find("input[name=metr]").val();
        
        price = parseInt(price) * parseInt(km);
        form.find("input[name=price]").val(price + "р");
        return false;
    });
    /*
    //Здесь старая обработка формы
    $(".popup_feedback form").submit(function(){
        var form = $(this);
        var error = false;
        
        form.find("input").each(function(){
			if($(this).val()==''){
				$(this).css({"outline":"1px solid red"});
				error = true;
			}
        })
        
        if(!error){
			var data = form.serialize();
			
			$.ajax({
				type: 'POST',
				url: 'http://ybery.su/bok.php', 
				dataType: 'json', 
				data: data, 
				beforeSend: function(data) { 
					form.find('input[type="submit"]').attr('disabled', 'disabled');
				},
				success: function(data){
					if (data['error']) {
						alert(data['error']);
					} else {
					    form.trigger( 'reset' );
                        popupHide($(".popup"), $(".transparent"))
                        alert("Заявка отправлена, мы перезвоним Вам в ближайшее время")
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
						alert("Возникла ошибка, пожалуйста, сообщите о ней нам по телефону, чтобы улучшить качество работы сайта, мы сделаем все возможное чтобы предотвратить подобные вещи в дальнейшем! Спасибо!")
				},
				complete: function(data) { 
					form.find('input[type="submit"]').prop('disabled', false); 
				}
			});
        }
        return false;
    })

    */
    $(".businesstext").find(".show_hover").width($(this).find(".sh_dop_info").width())
    $(".businesstext").hover(function(){
        $(this).find(".show_hover").addClass("a");
    }, function(){
        $(this).find(".show_hover").removeClass("a");
    })
})
function popupShow(el1, el2){
    el1.css({"top":$(window).scrollTop()+50}).stop().slideDown();
    el2.fadeIn();
}
function popupHide(el1, el2){
    el1.stop().slideUp();
    el2.fadeOut();
}
(function ($) {
	$(document).ready(function () {
		
	 var swiper = new Swiper('.shop-banner .swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
			 loop: true
    });
		
		$(".shop-pshow .pay button").click(function(){
			if($(this).hasClass("ture")){
				$(this).addClass("active").siblings(".ture").removeClass("active");
                $(".shop-pshow .paycheck").find(".txt span").text($(".shop-pshow .pay .active").attr("data-num")).siblings("em").text($(".shop-pshow .pay .active").text());
                $(".shop-pshow .pay .pay-is-jb").fadeOut(500);
			}
		});
		
		$(".shop-pshow .btn .submit-button").click(function(){
            var uid = $(this).attr('tid');
            if(uid == 0){
                return false;
            }
			if($(".shop-pshow .adr").length>0 && !$(".shop-pshow .adr span").hasClass("error")){
                $(".shop-pshow .paycheck").find(".txt span").text($(".shop-pshow .pay .active").attr("data-num")).siblings("em").text($(".shop-pshow .pay .active").text());
                var jb = $(".paycheck").find(".txt span").text();
                if(jb == 0){
                    $(".shop-pshow .pay .pay-is-jb").fadeIn(800);
                    return false;
                }
                $(".shop-pshow .paycheck").show();
			} else if($(".shop-pshow .adr").length>0 && $(".shop-pshow .adr span").hasClass("error")){
				$(".shop-pshow .adr span").addClass("tips");
			}else if($(".shop-pshow .adr").length<1){
                $(".shop-pshow .paycheck").find(".txt span").text($(".shop-pshow .pay .active").attr("data-num")).siblings("em").text($(".shop-pshow .pay .active").text());
                var jb = $(".paycheck").find(".txt span").text();
                if(jb == 0){
                    $(".shop-pshow .pay .pay-is-jb").fadeIn(800);
                    return false;
                }
                $(".shop-pshow .paycheck").show();
			}
		});
		
		$(".shop-pshow .paycheck .cancel-button").click(function(){
			$(this).parents(".paycheck").hide();
		});

        $(".shop-pshow .paycheck .submit-button").click(function(){
        	var $this = $(".shop-pshow .paycheck");
            var paid_jb = $this.find(".txt span").html();
            var paid_jb = parseInt(paid_jb);
            var txt = $this.find(".txt em").html();
            var my_jb = $this.find(".jb").html();
            var my_jb = parseInt(my_jb);
            var my_zjb = $this.find(".zjb").html();
            var my_zjb = parseInt(my_zjb);
            var goods_id = $(".shop-pshow").attr("tid");
            var an_number = $(".shop-pshow").attr("cid");
            var jbType = 0;

            var pay = $(".shop-pshow .pay button");
			if(pay.hasClass("active")){
				jbType = $(".shop-pshow .pay .active").attr("tid");
			}
            if(txt === '真贱币' && paid_jb>my_zjb) {
                $(".shop-pshow .pay .pay-is-jb").html('你的真贱币不够哦！').fadeIn(800);
                $(".shop-pshow .paycheck").hide();
                return false;
			}
			if (txt == '贱币' && paid_jb>my_jb) {
                $(".shop-pshow .pay .pay-is-jb").html('你的贱币不够哦！').fadeIn(800);
                $(".shop-pshow .paycheck").hide();
                return false;
			}

            var form = $("form.adrform");
            var data = 'an_number='+an_number+'&action='+jbType+'&paid_jb='+paid_jb+'&'+form.serialize()+'&txt='+txt+'&ajax=1';
            var target = siteurl+'user/markets/order-'+goods_id;
            $.post(target, data, function (d) {
                if (d.code == 400) {
                    alert(d.msg)
                }
                if (d.code == 200) {
                    if(d.goto){
                        window.location.href = d.goto;
                    }else{
                        window.location.reload();
                    }
                }
                $(".shop-pshow .paycheck").hide();
                return false;
            }, 'json');
            return false;
        });
		
		$(".shop-pshow .adr a").click(function(){
			$(".shop-pshow .adrcheck").show();
		});
		
		$(".shop-pshow .adrcheck .selectcheck .form-select").change(function(){
			$(this).siblings("input").val($(this).val());
		});

		$(".shop-pshow .adrcheck .cancel-button").click(function(){
			$(this).parents(".adrcheck").hide();
		});
		
		$(".adrform").Validform({
		dragonfly:false,
		showAllError:true,
		tipSweep:false,
		tiptype:3,
		btnSubmit:".submit-button",
		beforeSubmit:function(){
			$(".shop-pshow .adrcheck").hide();
			var $this = $(".adrform");
			var name = $this.find(".vname").val();
			var phone = $this.find(".vphone").val().replace(/^(\d{3})\d{4}(\d{4})$/,"$1****$2");
			var num = $this.find(".vnum").val();
			// var area = $this.find(".varea").val();
			// var city = $this.find(".vcity").val();
			var adr = $this.find(".vadr").val();

			var area = $this.find("select[name='province']").val();
			var city = $this.find("select[name='city']").val();

			$(".adr span").removeClass().html(name+"<i class='sp'/>"+phone+"<i class='sp'/>"+num+"<i class='sp'/>"+area+city+adr);


			// $(".adr span").removeClass().html($(".adrform").find(".vname").val()+"<i class='sp'/>"+$(".adrform").find(".vphone").val().replace(/^(\d{3})\d{4}(\d{4})$/,"$1****$2")+"<i class='sp'/>"+$(".adrform").find(".vnum").val()+"<i class='sp'/>"+$(".adrform").find(".varea").val()+$(".adrform").find(".vcity").val()+$(".adrform").find(".vadr").val());
			return false;
		}
		});
		
		
		
	});
})(window.jQuery);

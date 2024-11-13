(function($) {
	"use strict";
	var HT = {}; // Khai báo là 1 đối tượng
	var timer;
	var $carousel = $(".owl-slide");
	var _token = $('meta[name="csrf-token"]').attr('content');

	HT.swiperOption = (setting) => {
		// console.log(setting);
		let option = {}
		if(setting.animation.length){
			option.effect = setting.animation;
		}	
		if(setting.arrow === 'accept'){
			option.navigation = {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			}
		}
		if(setting.autoplay === 'accept'){
			option.autoplay = {
			    delay: 2000,
			    disableOnInteraction: false,
			}
		}
		if(setting.navigate === 'dots'){
			option.pagination = {
				el: '.swiper-pagination',
			}
		}
		return option
	}
	
	/* MAIN VARIABLE */
	HT.swiper = () => {
		if($('.panel-slide').length){
			let setting = JSON.parse($('.panel-slide').attr('data-setting'))
			let option = HT.swiperOption(setting)
			var swiper = new Swiper(".panel-slide .swiper-container", option);
		}
		
	}

	HT.carousel = () => {
		$carousel.each(function(){
			let _this = $(this);
			let option = _this.find('.owl-carousel').attr('data-owl');
			let owlInit = atob(option);
			owlInit = JSON.parse(owlInit);
			_this.find('.owl-carousel').owlCarousel(owlInit);
		});
		
	} 

	
	HT.swiperCategory = () => {
		var swiper = new Swiper(".panel-category .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 3,
			breakpoints: {
				415: {
					slidesPerView: 3,
				},
				500: {
				  slidesPerView: 3,
				},
				768: {
				  slidesPerView: 6,
				},
				1280: {
					slidesPerView: 10,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
	}


	HT.swiperProject = () => {
		var swiper = new Swiper(".panel-project .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 1,
			breakpoints: {
				415: {
					slidesPerView: 1,
				},
				500: {
				  slidesPerView: 1,
				},
				768: {
				  slidesPerView: 1,
				},
				1280: {
					slidesPerView: 3,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
	}


	HT.swiperNews = () => {
		var swiper = new Swiper(".panel-news .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 2,
			breakpoints: {
				300: {
					slidesPerView: 2,
				},
				500: {
				  slidesPerView: 2,
				},
				768: {
				  slidesPerView: 2,
				},
				1280: {
					slidesPerView: 4,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
	}

	HT.swiperPartner = () => {
		var swiper = new Swiper(".panel-partner .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 2,
			breakpoints: {
				415: {
					slidesPerView: 1,
				},
				500: {
				  slidesPerView: 2,
				},
				768: {
				  slidesPerView: 2,
				},
				1280: {
					slidesPerView: 6,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
	}
	
	
	

	HT.wow = () => {
		var wow = new WOW(
			{
			  boxClass:     'wow',      // animated element css class (default is wow)
			  animateClass: 'animated', // animation css class (default is animated)
			  offset:       0,          // distance to the element when triggering the animation (default is 0)
			  mobile:       true,       // trigger animations on mobile devices (default is true)
			  live:         true,       // act on asynchronously loaded content (default is true)
			  callback:     function(box) {
				// the callback is fired every time an animation is started
				// the argument that is passed in is the DOM node being animated
			  },
			  scrollContainer: null,    // optional scroll container selector, otherwise use window,
			  resetAnimation: true,     // reset animation on end (default is true)
			}
		  );
		  wow.init();


	}// arrow function

	HT.niceSelect = () => {
		if($('.nice-select').length){
			$('.nice-select').niceSelect();
		}
		
	}

	HT.select2 = () => {
		if($('.setupSelect2').length){
			$('.setupSelect2').select2();
		}
		
	}

	HT.openPreviewVideo = () => {
		$('.choose-video').on('click', function(e){
			e.preventDefault()
			let _this = $(this)
			let option = {
				id: _this.attr('data-id')
			}
			$.ajax({
				url: 'ajax/post/video', 
				type: 'GET', 
				data: option, 
				dataType: 'json', 
				beforeSend: function() {
					
				},
				success: function(res) {
					$('.video-preview .video-play').html(res.html)
					$('.video-preview video').attr('autoplay', 'autoplay');
					$('.video-preview iframe').attr('src', function (i, val) {
						return val + (val.indexOf('?') !== -1 ? '&' : '?') + 'autoplay=1';
					});
				},
			});

		})
	}

	HT.loadDistribution = () => {
		$(document).on('click', '.agency-item', function(){
			let _this = $(this)

			$('.agency-item').removeClass('active')
			_this.addClass('active')

			$.ajax({
				url: 'ajax/distribution/getMap', 
				type: 'GET', 
				data: {
					id: _this.attr('data-id')
				}, 
				dataType: 'json', 
				success: function(res) {
					$('.agency-map').html(res)
				},
			});

		})
	}


	HT.showAgencyInformation = () => {

		$('.showAgency').click(function(e){

			e.preventDefault()

			let _this = $(this)
			let agency = _this.attr('data-agency')
			agency = JSON.parse(agency)

			let field = ['name', 'email', 'phone', 'address', 'code']

			field.forEach(function(fieldName) {

				$('.popup-agency-' + fieldName).html(agency[fieldName])
			});


			var modal = UIkit.modal("#agency-popup");
				if ( modal.isActive() ) {
					modal.hide();
				} else {
					modal.show();
				}
		})


	}

	HT.showContact = () => {
		let isShown = false;
	
		$(document).on('click', '.bottom-support-online', function(){
			if (isShown) {
				$(this).removeClass('show');
				isShown = false;
			} else {
				$(this).addClass('show');
				isShown = true;
			}
		});
	};

	HT.showFakeOrder = () => {
		
		let randomData = [
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Phạm Thanh Tùng - Bình Dương",
				"hour": "35 phút trước",
				"message":  "Shop ơi có miễn phí ship tới Cao Bằng không ạ?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Nguyễn Văn A - Hà Nội",
				"hour": "1 giờ trước",
				"message": "Có thể giao hàng tới Hải Phòng không?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Trần Thị B - TP.HCM",
				"hour": "2 giờ trước",
				"message": "Sản phẩm này có sẵn size L không?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Lê Văn C - Đà Nẵng",
				"hour": "3 giờ trước",
				"message": "Em muốn đặt mua sản phẩm này."
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Phạm Thị D - Hà Tĩnh",
				"hour": "4 giờ trước",
				"message": "Có màu sắc khác không ạ?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Hoàng Văn E - Nghệ An",
				"hour": "5 giờ trước",
				"message": "Shop có chương trình giảm giá không ạ?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Nguyễn Văn F - Quảng Ninh",
				"hour": "6 giờ trước",
				"message": "Có thể đổi size không ạ?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Trần Thị G - Hải Phòng",
				"hour": "7 giờ trước",
				"message": "Shop có hỗ trợ thanh toán qua Zalo không ạ?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Lê Văn H - Vũng Tàu",
				"hour": "8 giờ trước",
				"message": "Có thể hủy đơn hàng được không ạ?"
			},
			{
				"img": "http://vphome24.com/frontend/resources/img/ao-thun-nam-trung-nien-pixi-10-500x500.jpg",
				"name": "Nguyễn Thị I - Nha Trang",
				"hour": "9 giờ trước",
				"message": "Sản phẩm này còn hàng không ạ?"
			}
		];
		


		let randomIndex = Math.floor(Math.random() * randomData.length);

		let data = randomData[randomIndex]

		let $html = ''

		$html += `<div class="noti-ava"><img src="${data.img}"></div><div class="noti-info"><div class="noti-title">${data.name}</div><div class="noti-des">Vừa bình luận ${data.message}- <span class="noti-time">${data.hour}</span></div></div>`

		$('#noti').html($html).css('bottom', '20px').fadeIn()

		setTimeout(() => {
			$('#noti').fadeOut(); // Hiệu ứng fadeOut
		}, 5000);
	
		// Chờ 30 giây trước khi hiển thị dữ liệu mới
		setTimeout(HT.showFakeOrder, 30000);

		
	}

	HT.removePagination = () => {
		$('.filter-content').on('slide', function() {
			$('.uk-flex .pagination').hide();
		});
	};


	HT.wrapTable = () => {
		var width = $(window).width()
		if(width < 600){
			$('table').wrap('<div class="uk-overflow-container"></div>')
		}
	}

	HT.scrollToDiv = () => {
		$(document).on('click','.scroll-div', function(e){
            e.preventDefault();
			let _this = $(this)
			let target = _this.attr('href')
			let targetOffset =  $(target).offset().top - 80
			$('html, body').animate({
				scrollTop: targetOffset
			}, 500); 
		})
	}
    
	HT.addBtnSearch = () => {
		$(document).on('click', '.btn-search .image', function(e){
			e.preventDefault()
			if ($('.header-form').hasClass('active')) {
				$('.header-form').removeClass('active');
			} else {
				$('.header-form').addClass('active');
			}
		});
	}

    HT.introduce = () => {
		var swiper = new Swiper(".slide-introduce .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 1,
            autoplay: {
                delay : 2000
            },
			breakpoints: {
				415: {
					slidesPerView: 1,
				},
				500: {
				  slidesPerView: 1,
				},
				768: {
				  slidesPerView: 1
				},
				1280: {
					slidesPerView: 1,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
		
	}

    HT.popupSwiperVideo = () => {
		document.querySelectorAll(".panel-video .popup-video").forEach(popup => {
			var swiper = new Swiper(popup.querySelector(".swiper-container"), {
				loop: true,
				// autoplay: {
				// 	delay: 2000,
				// 	disableOnInteraction: false,
				// },
				pagination: {
					el: '.swiper-pagination',
				},
				thumbs: {
					swiper: {
						el: popup.querySelector('.swiper-container-thumbs'),
						slidesPerView: 4,
						spaceBetween: 20,
						slideToClickedSlide: true,
					}
				}
			});
		});
	}

    HT.catalogue = () => {
		var swiper = new Swiper(".product-catalogue .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			// spaceBetween: 20,
			slidesPerView: 1,
            // autoplay: {
            //     delay : 2000
            // },
			breakpoints: {
				415: {
					slidesPerView: 2,
				},
				500: {
				  slidesPerView: 1,
				},
				768: {
				  slidesPerView: 1
				},
				1280: {
					slidesPerView: 5,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
		
	}

    HT.construction = () => {
		var swiper = new Swiper(".panel-construction .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 1,
            // autoplay: {
            //     delay : 2000
            // },
			breakpoints: {
				415: {
					slidesPerView: 2,
				},
				500: {
				  slidesPerView: 1,
				},
				768: {
				  slidesPerView: 1
				},
				1280: {
					slidesPerView: 4,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
		
	}

    HT.brand = () => {
		var swiper = new Swiper(".panel-brand .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 1,
            autoplay: {
                delay : 2000
            },
			breakpoints: {
				415: {
					slidesPerView: 2,
				},
				500: {
				  slidesPerView: 1,
				},
				768: {
				  slidesPerView: 1
				},
				1280: {
					slidesPerView: 6,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
		
	}

    HT.best = () => {
		var swiper = new Swiper(".panel-best-seller .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 1,
            autoplay: {
                delay : 2000
            },
			breakpoints: {
				415: {
					slidesPerView: 1,
				},
				500: {
				  slidesPerView: 1,
				},
				768: {
				  slidesPerView: 1
				},
				1280: {
					slidesPerView: 5,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
		
	}

    HT.viewAll = () => {
        $(document).on('click','.view-all', function(){
            let _this = $(this)
            _this.addClass('hide')
            _this.closest('.panel-product-detail').find('.product-content-wrap').addClass('auto-height');
            $('.view-hide').removeClass('hide')
        });
    }

    HT.viewHide = () => {
        $(document).on('click','.view-hide', function(){
            let _this = $(this)
            _this.closest('.panel-product-detail').find('.product-content-wrap').removeClass('auto-height');
            _this.addClass('hide')
            $('.view-all').removeClass('hide')
        });
    }
    

    HT.search = () => {
        $(document).on('click','.txt-sr', function(){
            let _this = $(this)
            _this.closest('.header-lower').find('.header-search').removeClass('hide');
        });
    }

    HT.close = () => {
        $(document).on('click','.btnCloseSearch', function(){
            let _this = $(this)
            _this.closest('.header-lower').find('.header-search').addClass('hide');
        });
    }



	$(document).ready(function(){
        HT.close()
        HT.search()
        HT.viewAll()
        HT.viewHide()
        HT.best()
        HT.brand()
        HT.construction()
        HT.catalogue()
        HT.popupSwiperVideo()
        HT.introduce()
		HT.addBtnSearch()
		HT.scrollToDiv()
		HT.swiperPartner()
		HT.swiperNews()
		HT.removePagination()
		HT.showContact()
		HT.wow()
		HT.swiperCategory()
		
		// HT.swiperIntro()
		HT.swiperProject()
		/* CORE JS */
		HT.swiper()
		HT.niceSelect()		
		HT.carousel()

		HT.select2()

		HT.loadDistribution()

		HT.openPreviewVideo()

		HT.showFakeOrder()

		HT.showAgencyInformation()
		HT.wrapTable()
	});

})(jQuery);



addCommas = (nStr) => { 
    nStr = String(nStr);
    nStr = nStr.replace(/\./gi, "");
    let str ='';
    for (let i = nStr.length; i > 0; i -= 3){
        let a = ( (i-3) < 0 ) ? 0 : (i-3);
        str= nStr.slice(a,i) + '.' + str;
    }
    str= str.slice(0,str.length-1);
    return str;
}
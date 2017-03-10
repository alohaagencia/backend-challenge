$(function () {
	
	'use strict';

	var doc = $(document), that, parent;

	doc.on({
		'ready': function () {
			if (window.location.hash) {
				$('.tabs .labels .label, .tabs .tab').removeClass('on');
				$('.tabs .labels .label.'+ window.location.hash.replace('#', '')).addClass('on');
				
				$('.tabs .tab.'+ window.location.hash.replace('#', '')).addClass('on');
			}
		},

		'click' 	: function (event) {

			that 		= $(event.target);
			parent 		= $(event.target.parentNode);

			// CONFIRM
			if(that.hasClass('js-confirm')) {
				var confirm 	= $('[data-remodal-id=confirm]').remodal(),
					redirectUrl	= that.attr('href');

				var title 		= 'Remover',
					message		= 'Esta ação não pode ser revertida, todas as informações serão perdidas.',
					confirmText	= 'Ok';

				if (that.data('title'))
					title = that.data('title');

				if (that.data('message'))
					message = that.data('message');

				if (that.data('confirm'))
					confirmText = that.data('confirm');

				$('[data-remodal-id=confirm] .remodal-title').text(title);
				$('[data-remodal-id=confirm] .remodal-message').text(message);
				$('[data-remodal-id=confirm] .remodal-confirm').text(confirmText);

				confirm.open();

				$(document).on('confirmation', '[data-remodal-id=confirm]', function () {
					window.location.href = redirectUrl;
				});

				event.preventDefault();
			}

			if(that.hasClass('md-confirm-mask')) {
				$('.md-confirm').removeClass('show');
				event.preventDefault();
			}

			// JS CALL TAB
			if(that.hasClass('label js-call-tab') && !that.hasClass('on')) {

				var tabs 	= that.parent().siblings('.tab'),
					labels 	= that.siblings('.label'),
					target 	= that.index() - that.siblings('.title').length;

				tabs.removeClass('on');
				labels.removeClass('on');

				that.addClass('on');
				tabs.eq(target).addClass('on');

				event.preventDefault();

			}

			// JS CLOSE CALLOUT
			if(that.hasClass('js-close-callout')) {

				that.parent('.callout').remove();
				event.preventDefault();

			}

			// JS CALL GROUP
			if(that.hasClass('js-call-group')) {

				var menu 	= that.next('menu'),
					group 	= that.parent('li'),
					groups 	= $('.menu > li');

				if(menu.length) {

					if(group.hasClass('on'))
						group.removeClass('on');
					else {

						groups.removeClass('on');
						group.addClass('on');
					
					}

					event.preventDefault();
				
				}

			}

			// JS CALL MENU
			if(that.hasClass('js-call-menu') || parent.hasClass('js-call-menu')) {

				if(!parent.hasClass('js-call-menu'))
					that.toggleClass('on');
				else
					parent.toggleClass('on');

				$('.menu').toggleClass('on');

				event.preventDefault();

			}

			// JS SCROLL TO
			if(that.hasClass('js-scroll-to')) {

				var target = that.data('target'),
					offset = $(target).offset();

				if(offset)
					$('html, body').animate({
						scrollTop : offset.top
					}, 'fast');
				
				event.preventDefault();

			}

		}

	});

});
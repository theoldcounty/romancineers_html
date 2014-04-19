	var privatemessageHandler = {
		disableMovement: false,
		messageConfiguration: function(){
			
			//do visually on pane - if on pane.
			
			
			//do visually on list
			
			//do required action on backend.
		},
		invoke: function(el){
			var that = this;
			
			var privateHandler = $(".message-handler");			
			var parentSwiperId = $(el).closest('[data-role="swiper"]').attr("id");
			var parentSwiper = swiper.getSwiper(parentSwiperId);
			
			that.bindcheck(el);
			
			privateHandler.find("a").click(function(e) {
				e.preventDefault();
				var that = this;

				var actionableItems = new Array();
				$('.private-message-list:visible li').each(function(index, value){
					if($(value).find('.private-message-marker').is(":checked")){
						actionableItems.push(value);
					}
				});
				
				switch($(this).attr("class"))
				{
					case "delete":
						//deleted
						$(actionableItems).each(function(index, value){
							//delete on backend
							var messageId = $(value).data("message-id");
							
							//visually delete
							$(value).fadeOut(350, function(){
								$(value).remove();
								$('.view-list-trigger').click();
							});
						});
					break;
					case "markasunread":
						//execute markasunread
					break;
					case "markread":
						//execute markread
					break;
				}
			});
			
			$(el).find(".view-message-trigger").click(function() {
				if(!that.disableMovement){
					//destry scroller on private pane - remove old data
					mcustomscroller.destroy($(el).find(".private-pane").find(".message-body"));
					
					that.populatePane(el, $(this).closest("li"));
					that.bindcheck(el);
					
					//init scroller on private pane - for new data
					mcustomscroller.init($(el).find(".private-pane").find(".message-body"));
					
					parentSwiper.reInit();
					swiper.nextSwipe(parentSwiper);
				}
			});
			
			$(el).find(".view-list-trigger").click(function(e) {
				e.preventDefault();
				parentSwiper.reInit();
				swiper.prevSwipe(parentSwiper);
			});
		},
		bindcheck: function(el){
			//console.log("bind checkbox");
			var that = this;
			$(el).find(".private-message-marker").on("click",function(e){
				//e.preventDefault();
				that.disableMovement = true;				
				
				var id = $(this).data("message-id");				
				//global match checkbox attributes
				if($(this).is(":checked")){
					//checked
					$('.private-message-marker[data-message-id="'+id+'"]').attr("checked", "checked");
				}
				else{
					//not checked
					$('.private-message-marker[data-message-id="'+id+'"]').removeAttr("checked");
				}							
				
				//reenable
				setTimeout(function(){
					that.disableMovement = false;
				},100);
			});		
		},
		populatePane: function(el, list){
			//private-pane
			$(el).find(".private-pane").find(".user-image").html(list.find(".user-image").html());
			$(el).find(".private-pane").find(".user-name").text(list.find(".user-name").html());
			$(el).find(".private-pane").find(".user-date").text(list.find(".user-date").html());
			$(el).find(".private-pane").find(".message-subject").text(list.find(".message-subject").text());
			$(el).find(".private-pane").find(".message-body").text(list.find(".message-body").html());
		}
	};
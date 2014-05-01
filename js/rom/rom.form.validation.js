
	var validateForm = {
		invoke: function(el){
			var that = this;

			var options = {
				rules: {},
				messages: {}
			}

			el.find('input[type=text], input[type=password], input[type=email], input[type=checkbox], textarea').each(function( index ) {
				options["rules"][$(this).attr("name")] = {};
				options["messages"][$(this).attr("name")] = {};
				
				if($(this).data("required")){
					options["rules"][$(this).attr("name")]["required"] = $(this).data("required");
					options["messages"][$(this).attr("name")]["required"] = $(this).data("message-required");
				}

				if($(this).data("minlength")){
					options["rules"][$(this).attr("name")]["minlength"] = $(this).data("minlength");
					options["messages"][$(this).attr("name")]["minlength"] = $(this).data("message-minlength");
				}

				if($(this).data("email")){
					options["rules"][$(this).attr("name")]["email"] = $(this).data("email");
					options["messages"][$(this).attr("name")]["email"] = $(this).data("message-email");
				}
				
				if($(this).data("equal-to")){
					options["rules"][$(this).attr("name")]["equalTo"] = $(this).data("equal-to");
					options["messages"][$(this).attr("name")]["equalTo"] = $(this).data("message-equal-to");
				}
				
			});
			
			options["submitHandler"] = function() { 
				that.submithandler(); 
			}
			
			console.log("options", options);
			
			el.validate(options);
			
			function GetImageVal(imgEl, callback){
				var fullPath = imgEl.val();
				
				if (fullPath) {
					var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
					var filename = fullPath.substring(startIndex);
					if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
						filename = filename.substring(1);
					}
					callback(filename);
				}			
			}

			el.find('input[type=file]').each(function( index ) {
				$(this).parent().prepend('<div class="imagefileholder">'+$(this).data("placeholder")+'</div>');
			});

			
			el.find('input[type=file]').fileValidator({
				onValidation: function(files){
					/* Called once before validating files */ 
					
					$(this).attr('class','');
					
					var imageHolder = $(this).parent().find(".imagefileholder");
					imageHolder.removeClass('invalid');
					
					GetImageVal($(this), function(filename){
						imageHolder.text(filename);
						console.log("filename", filename);
					});
					
				},
				onInvalid: function(type, file){
					/* Called once for each invalid file */
					
					var imageHolder = $(this).parent().find(".imagefileholder");
					
					var errorMessage = $(this).data("error-message");
					var maxVal = $(this).data("max-size");
					errorMessage = errorMessage.replace("%",maxVal);
					
					console.log("errorMessage", errorMessage);
					
					imageHolder.addClass('invalid');
					$(this).addClass('invalid '+type);
				},
				maxSize: '1m'
			});
			
		},
		imageHandler: function(){
		
		},
		submithandler: function(){
			alert("submitted 2 1!")
		}
	}
	
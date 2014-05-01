

var previewImage = {
	invoke: function(el){
		var that = this;
		
		el.find("input").change(function() {
			if(!el.find("input").hasClass("invalid")){
				that.previewImage(el);
			}
		});	
	},
	previewImage: function(el) {
		var previewSection = el.find(".previewimage");
		var oFReader = new FileReader();
		
		if(oFReader){
			oFReader.readAsDataURL(el.find("input")[0].files[0]);

			oFReader.onload = function (oFREvent) {
				previewSection.find("img").attr("src", oFREvent.target.result);
				galleryFix.invoke(previewSection);
			};
		}
    }
}
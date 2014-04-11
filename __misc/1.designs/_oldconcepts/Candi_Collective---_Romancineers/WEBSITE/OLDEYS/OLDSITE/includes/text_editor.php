
			<form id="form1" name="preview" action="catalog.php?a=<?php echo''.$a.''; if(isset($id)){echo'&amp;id='.$id.'';}?>" method="post">
            	<input type="hidden" name="todo" value="update-profile">
                <div id="uploaded_image2"></div>
				<div class="form_row">					
					<label class="mylabelstyle">Name:</label>
                    <input type="text" class="myinputstyle" name="name" size="50" value="<?php echo''.$name.'';?>"/>
				</div>
				<div class="form_row">
                    <label class="mylabelstyle">Description:</label>                              
                    <textarea id="editor" name="editor" class="myinputstyle" rows="20" cols="75">
                    <?php echo''.$editor.''; ?>
                    </textarea>								  		                
                    </div>
				<div class="form_row">
                    <label class="mylabelstyle">Category:</label>  
                    
                    <select class="myinputstyle" name="category" onChange="SelectSubCat();" >
                    	<?php if(isset($category)){ echo'<option value="'.$category.'">'.$categoryname.'</option>';} ?>
                        <option value="">Category</option>
                    </select>
                    <select class="myinputstyle" id="subcat" name="subcat">
                    	<?php if(isset($subcat)){ echo'<option value="'.$subcat.'">'.$subcat.'</option>';} ?>
                        <option value="">SubCat</option>
                    </select>                    
                    
                												                
                </div>                    
				<div class="form_row">	
	                <label class="mylabelstyle">Input:</label>  			
					<input class="myinputstyle" type="reset" value="Reset" size="20" />
					<input class="myinputstyle" type="submit" name="save" value="Submit" size="20" />
				</div>
			</form>
<script>

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    var myConfig = {
        height: '300px',
        width: '350px',
		handleSubmit: true,
        dompath: true,
        focusAtStart: true
    };

    YAHOO.log('Create the Editor..', 'info', 'example');
    var myEditor = new YAHOO.widget.SimpleEditor('editor', myConfig);
    myEditor.render();
	


})();
</script>
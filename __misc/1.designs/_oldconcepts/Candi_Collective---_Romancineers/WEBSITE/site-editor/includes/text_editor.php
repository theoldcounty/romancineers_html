
			<form id="form1" name="preview" action="journal.php?a=<?php echo''.$a.''; if(isset($id)){echo'&amp;id='.$id.'';}?>" method="post">
            	<input type="hidden" name="todo" value="update-profile">
                <div id="uploaded_image2"></div>
				<div class="form_row">					
					<label class="mylabelstyle">Name:</label>
                    <input type="text" class="myinputstyle" name="name" size="70" value="<?php echo''.$name.'';?>"/>
				</div>
				<div class="form_row">
                    <label class="mylabelstyle">Description:</label>                              
                    <textarea id="editor" name="editor" class="myinputstyle" rows="20" cols="75">
                    <?php echo''.$editor.''; ?>
                    </textarea>								  		                
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
        width: '450px',
		handleSubmit: true,
        dompath: false,
        focusAtStart: true,

		toolbar: {
	collapse: true,
	draggable: false,
	buttons: [
	
		{ type: 'separator' },
		{ group: 'textstyle', label: 'Font Style',
			buttons: [
				{ type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
				{ type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
				{ type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },
				{ type: 'separator' },
			]
		},
		{ type: 'separator' },
		{ group: 'indentlist', label: 'Lists',
			buttons: [
				{ type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' },
				{ type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }
			]
		},
		{ type: 'separator' },
		{ group: 'insertitem', label: 'Insert Item',
			buttons: [
				{ type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: true },
			]
		}
	]
		
		}
		
    };

    YAHOO.log('Create the Editor..', 'info', 'example');
    var myEditor = new YAHOO.widget.SimpleEditor('editor', myConfig);
    myEditor.render();
	



})();
</script>
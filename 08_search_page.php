<?php include "includes/header.php";?>
			
				<!--<div class="flask">--><!--flask-->
					<div class="batch">
						
		
<style>


#map {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

#placeholder{
    width: 100%;
    height: 100%;      
}


ul.menu{
    list-style-type:none;
    background: grey;
    margin:0;
    overflow:hidden;
}

ul.menu li{
    background: #333333;
    float:left;
    padding: 5px;
    margin-right:2px;
}

ul.menu li a{
    text-decoration: none;
    font-size: 11px;
    color: #ffffff;
}
</style>



<ul class="menu">
    <li class="clearing"><a href="#">CLEAR</a></li>      
    <li class="editing"><a href="#">EDIT</a></li>  
    <li class="drawing"><a href="#">DRAW</a></li> 
    <li class="drawfreehand"><a href="#">DRAW FREEHAND</a></li> 
    
    
    <li class="clearmarkers"><a href="#">clearmarkers</a></li> 
    <li class="showmarkers"><a href="#">showmarkers</a></li> 
</ul>

<div class="googlemaps">
    <div id="map_canvas"></div>
</div>						
						
						
						
					</div>				
				<!--</div>--><!--flask-->
				
<?php include "includes/footer.php";?>

<div id="rightcol">




<?php
if(!isset($_SESSION['id']))
{
?>


<!-- login -->
<div class="login">

	<h2>login</h2>

<form id="login" class="gloss" enctype="multipart/form-data" method="post" action="logins.php?e=login#">
    <ul>
    <li>
	    <label class="desc" for="userid">User ID</label>
    <div>
	    <input id="userid" name="userid" type="text" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
    </div>
    </li>
    
    <li>
    	<label class="desc" for="password">Password</label>
    <div>
    <input id="password" name="password" type="password" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
    </div>
    
    <input type="image" name="submit" value="Login" class="field_login" src="../graphics/login.jpg" alt="submit"/>
    </li>
    </ul>
</form>
    
    <div class="clr"></div>
    <a href="logins.php?e=signup">Sign Up</a> | <a href="logins.php?e=forgot_password">Forgot Password</a>

</div>
<!-- login -->




<?php
}
else
{
?>



<!-- logged in -->
<div class="login" id="edit_profile">
 
 	<h2>hi, <a href="edit.php?e=status"><?php echo''.$_SESSION[userid].''; ?></a></h2>
    <ul>
        <li><a href="edit.php?e=aboutdate">What kind of date do you want?</a></li>
        <li><a href="edit.php?e=bio">Bio</a></li>
        <li><a href="edit.php?e=appearance">Appearance</a></li>
        <li><a href="edit.php?e=personality">Personality</a></li>
        <li><a href="edit.php?e=background">Background</a></li>
        <li><a href="edit.php?e=interests">Interests</a></li>
        <li><a href="edit.php?e=lifestyle">Lifestyle</a></li>        
    </ul>    
    <br/><br/><br/>
    
    <br/><a href="edit.php?e=editaccount">Edit Account</a> / <a href="logins.php?e=logout">Sign Out</a>

</div>
<!-- logged in -->


<?php
}
?>


<?php
if(empty($e))
{
?>
    <!-- search -->
    <div class="search">
    
        <h2>quick search</h2>
    
    <form id="search" class="gloss" enctype="multipart/form-data" method="post" action="browsing.php?e=ba#">
        <ul>
        <li>
            <label class="desc" for="what_is_your_gender">
            What is your gender?
            </label>
            <div>
                <select id="what_is_your_gender" name="what_is_your_gender" class="field_select_medium" tabindex="15"> 
                    <option value="1" <?php if($what_is_your_gender==1){?>selected="selected"<?php }?> >Man</option>
                    <option value="2" <?php if($what_is_your_gender==2){?>selected="selected"<?php }?>>Woman</option>
                </select>
            </div>
        </li>
        
        
        
        <li>
            <label class="desc" for="gender_you_looking_for">
            Who are you looking for?
            </label>
            <div>
                <select id="gender_you_looking_for" name="gender_you_looking_for" class="field_select_medium" tabindex="15"> 
                <option value="2" <?php if($gender_you_looking_for==2){?>selected="selected"<?php }?>>Woman</option>
                <option value="1" <?php if($gender_you_looking_for==1){?>selected="selected"<?php }?>>Man</option>
                </select>
            </div>
        
        <div>
            <label class="desc" for="age_range_you_looking_for1">
            Between the ages
            </label>
                
            
            <select id="age_range_you_looking_for1" name="age_range_you_looking_for1" class="field_select_small" tabindex="15">
            <?php
            for($i=18; $i<=121; $i++)
            {
                ?><option value="<?php echo''.$i.'';?>" <?php if(($i==18 && empty($age_range_you_looking_for1)) || ($i==$age_range_you_looking_for1)){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
            }
            ?>
            </select>
            and
            
            <select id="age_range_you_looking_for2" name="age_range_you_looking_for2" class="field_select_small" tabindex="15"> 
            <?php
            for($i=18; $i<=121; $i++)
            {
                ?><option value="<?php echo''.$i.'';?>" <?php if(($i==39 && empty($age_range_you_looking_for2)) || ($i==$age_range_you_looking_for2)){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
            }
            ?>
            </select>           
        </div>	
        </li>
        
        <li>
            <label class="desc" for="which_country">
            Which country?
            </label>
            <div>
                <select id="which_country" name="which_country" class="field_select_medium" tabindex="15"> 
            <?php
        
                    $q2 = "SELECT * FROM `_country`";
                    $c1->query($q2);		
                    
                    if($rec=$c1->fetchAll())
                    {  
                        ?><option value="" <?php if($which_country==""){?>selected="selected"<?php }?>>Any</option><?php
                        foreach ($rec as &$value)
                        {
                            ?><option value="<?php echo''.$value[id].'';?>" <?php if($which_country==$value[id]){?>selected="selected"<?php }?>><?php echo''.$value[country].'';?></option><?php
                        }
                    }
            ?>
                </select>
                
                <input type="hidden" name="ba" value="1"/>
                <input type="hidden" name="e" value="ba"/>
                <input type="image" name="submit" value="submit" class="field_submit" src="../graphics/search.jpg"/>
            </div>
        </li>    
        </ul>
        </form>
        <a href="browsing.php?e=ad"><img class="field_submit" src="../graphics/advanced.jpg" alt="Search"/></a>
    </div>
    <!-- search -->
<?php
}
?>




</div>
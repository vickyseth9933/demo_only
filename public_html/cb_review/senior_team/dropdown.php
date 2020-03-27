<html>
<head>
 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
$('#types').change(function(){
if($('#types').val() == 'Other')
   {
   $('other').css('display', 'block'); 
      }
else
   {
   $('other').css('display', 'none');
   }
});
});
</script>
 
</head>
 
<body>
 
<select id="types" name="types" >
 <option value="Type 1">Type 1</option>
 <option value="Type 2">Type 2</option>
 <option value="Type 3">Type 3</option>
 <option value="Other">Other</option>
</select>
 
  <input type="text" id="other" style="display: none;" />
 
</body>
 
</html>
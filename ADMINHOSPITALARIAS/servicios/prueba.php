<script type="text/javascript">
function launchIt() {
var form = document.search;
var select = form.select;
var option = select.options[select.selectedIndex];

select.selectedIndex = 0;
form.target = option.getAttribute('name');
form.action = option.value;
form.submit();
//form.target = '';
//form.action = '';
}
</script>

<form method="post" name="search">
<select name="select" onChange="launchIt()" style="font-size:9px">
<option value="">Select Service</option>
<option value="http://www.google.com/" name="google">Google</option>
<option value="http://www.hotbot.com/" name="hotbot">Hotbot</option>
</select>
</form>
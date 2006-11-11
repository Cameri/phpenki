<html>
<head>
<?php
$dir = $_GET["dir"];
$theme = $_GET["theme"];
?>
<script type="text/javascript">
var xmlHttp
var cur_id

function AlterBranch(dir, id){
 cur_id = id
 if(document.getElementById(id + "_img").src=="<?php echo("http://" . dirname($_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) . "/themes/" . $_GET["theme"]);?>/images/tree_dir_close.gif"){
  AddBranch(dir, id)
 }
 else{
  RemoveBranch(id)
 }
}

function RemoveBranch(id){
 document.getElementById(id + "_img").src="themes/<?php echo($theme);?>/images/tree_dir_close.gif"
 document.getElementById(id).innerHTML=""
}

function AddBranch(dir, id){ 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null){
  alert ("Browser does not support HTTP Request")
  return
 }
 var url="getbranch.php"
 url=url+"?dir="+dir
 url=url+"&id="+id+"_"
 url=url+"&theme=<?php echo($theme); ?>"
 xmlHttp.onreadystatechange=stateChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function stateChanged(){
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
  document.getElementById(cur_id).innerHTML=xmlHttp.responseText
  document.getElementById(cur_id + "_img").src="themes/<?php echo($theme);?>/images/tree_dir_open.gif"
 } 
} 

function GetXmlHttpObject(){ 
 var objXMLHttp=null
 if (window.XMLHttpRequest){
  objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject){
  objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp
}
</script>

<link rel="stylesheet" type="text/css"
href="themes/<?php echo($theme); ?>/style.css" />

</head>
<body>
<?php
  echo("http://" . dirname($_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) . "/" . $dir);
  include("http://" . dirname($_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) . "/getbranch.php?dir=" . $dir . "/&id=branch&theme=" . $theme);
?>
</body>
</html>
<?php 
$url=$_GET['url'];
$tid=$_GET['tid'];
?>
<script>
    window.location.href = "http://<?php echo $url;?>/?tid=<?php echo $tid;?>";
</script>
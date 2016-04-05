<?php
class Thumbnail{
var $filename;
var $filename2;
var $imageP;
var $image;
var $infoImage=array();
var $maxW=180;
var $maxH=135;
var $Text="";
var $type="";

var $setTypeImg=array(
    "png"=>array("imagepng","ImageCreateFromPng"),
    "jpeg"=>array("imagejpeg","ImageCreateFromJpeg"),
    "jpg"=>array("imagejpeg","ImageCreateFromJpeg"),
    "gif"=>array("imagegif","ImageCreateFromGif"),
    "bmp"=>array("imagebmp","ImageCreateFromBmp")
);

var $blanc ;

function SetNewWH(){
	//list($w, $h) = getimagesize($this->filename);
	$imginfo = getimagesize($this->filename);
	$w=$imginfo[0];
	$h = $imginfo[1];
	$this->type = $imginfo["mime"];
	$nh=($this->maxW/$w)*$h;
	$this->infoImage[0]=$w;
	$this->infoImage[1]=$h;
	$this->infoImage[2]=$this->maxW;
	$this->infoImage[3]=ceil($nh);
}

function MakeNew(){
	$this->imageP = imagecreatetruecolor($this->infoImage[2], $this->infoImage[3]);
/*$this->ext=strrchr(strtolower(basename($this->filename)), '.');
$this->ext=substr($this->ext, 1);
$this->image = $this->setTypeImg[$this->ext][1]($this->filename);*/

	if($this->type=='image/png'){
		$this->type="png";
		//$this->image = imagecreatefrompng($this->filename);
	}elseif($this->type=='image/jpeg'){
		$this->type="jpeg";
		//$this->image = imagecreatefromjpeg($this->filename);
	}elseif($this->type=='image/gif'){
		$this->type="gif";
		//$this->image = imagecreatefromgif($this->filename);
	}elseif($this->type=='image/bmp'){
		$this->type="bmp";
		//$this->image = imagecreatefrombmp($this->filename);
	}
	else{
		$this->type="jpg";
	}
	$this->image = $this->setTypeImg[$this->type][1]($this->filename);
	$this->blanc= imagecolorallocate ($this->image,0xff,0xee,0xc5);
}



function FinirPImage(){

	imagecopyresampled($this->imageP, $this->image, 0, 0, 0, 0, $this->infoImage[2], $this->infoImage[3], $this->infoImage[0], $this->infoImage[1]);
	if($this->Text)
	imagestring ($this->imageP, 3, 2, $this->infoImage[3]-16, $this->Text, $this->blanc);
	/*if($this->ext=="png"){
		imagepng($this->imageP, $this->filename2, 1);
	}
	else{
		imagejpeg($this->imageP, $this->filename2, 98);
	}*/
	$compressonlabel=98;
	if($this->setTypeImg[$this->type][0]=="imagepng"){
		$compressonlabel=9;
	}
	$this->setTypeImg[$this->type][0]($this->imageP, $this->filename2, $compressonlabel);
	imagedestroy($this->imageP);
}


}
?>
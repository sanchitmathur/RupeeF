<?PHP
App::uses('Component', 'Controller');
App::import('Vendor','Thumbnail' ,array('file'=>'thumbnail.class.php'));

class ThumbComponent extends Component {

	/**
	 * Processes the payment
	 */
	    public function createthumb( $source, $destination, $width=100, $height = 0 ) {
			$pic=new Thumbnail();
			$pic->filename = $source;
			$pic->filename2 = $destination;
			$pic->maxW = ($width>0)?$width:100;
			if( $height>0 ){
				$pic->maxH = $height;
			}
			$pic->SetNewWH();
			$pic->MakeNew();
			$pic->FinirPImage();
	    }
}
?>
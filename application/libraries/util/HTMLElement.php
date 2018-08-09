<?
	class HTMLElement{
		public function  HTMLElement($tagName = ""){
			$this->tagName			= $tagName;	
		}
		/**
		 *		@PARAM	Array
		*/
		public function setAttr($arr){
			$this->attributes = $arr;
		}
		/**
		 *		@RETURN 	Array
		*/
		public function getAttr(){
			return $this->attributes;	
		}
		
		
		/**
		 *		@PARAM	String,String
		*/
		public function addAttrValue($attrName, $attrValue){
			$this->attributes[$attrName]		= $attrValue;
		}
		/**
		 *		@RETURN	String
		*/
		public function getAttrValue($attrName){
			return $this->attributes[$attrName];	
		}		
		
		
		/**
		 *		@PARAM	String
		*/
		public function setName($tagName){
			$this->tagName		= $tagName;
		}
		/**
		 *		@RETURN	String
		*/
		public function getName(){
			return $this->tagName;	
		}		
		/**
		 *		@PARAM	String
		*/
		public function setValue($val){
			$this->value	 = $val;
		}
		/**
		 *		@PARAM	String
		*/
		public function getValue(){
			return $this->value;	
		}
		
		/**
		 *		@PARAM	String
		*/
		public function setStylesheet($stylesheer){
				$this->stylesheet = $stylesheer;
		}
		/**
		 *		@RETURN 	String
		*/
		public function getStylesheet(){
			return $this->stylesheet;	
		}
		
		
		
		
		
		
		
		
		public function create(){
			$attr		= "";
			foreach($this->attributes			as		$k=>$v){
				$attr	.= "{$k}=\"{$v}\" ";
			}
			return "	<". $this->tagName ." {$attr} style=\"".$this->stylesheet."\" >
								{$this->value}
							</". $this->tagName .">";	
		}
		
		
		public static function creator($tagName, $attr=array(), $stylesheet="", $value=""){
			$obj			= new HTMLElement($tagName);
			$obj->setAttr($attr);
			$obj->setStylesheet($stylesheet);
			$obj->setValue($value);
			return $obj->create();
		}
				
		
		// Class variables		
		private $attributes								= array();				// Array
		private $stylesheet								= null;				// String
		private $tagName								= null;				// String
		private $value										= null;				// String
	}
	
	
	
	/*
	 *		Example
	 *		$element =  HTMLElement::creator("div",array("id"=>"id","name"=>"name"),"background-color:red; ","This is  value");
	 *		echo $element;
	 */
	
	
?>
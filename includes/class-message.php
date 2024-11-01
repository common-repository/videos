<?php
class Video_Message_Class {
	
	public $msg_var = 'video_msg';
	
	public $msg_class_var = 'video_msg_class';
	
	public function __construct( $msg_var = '', $msg_class_var = '' ){
		if( $msg_var ){
			$this->msg_var = $msg_var;
		}
		if( $msg_class_var ){
			$this->msg_class_var = $msg_class_var;
		}
	}
	
	public function add( $msg = '', $class = '' ){
		if( $msg ){
			$_SESSION[$this->msg_var] 		= $msg;
			$_SESSION[$this->msg_class_var] = $class;
		}
	}
	
	public function show(){
		if( isset( $_SESSION[$this->msg_var] ) ){
			echo '<div class="' . $_SESSION[$this->msg_class_var] . '"><p>' . $_SESSION[$this->msg_var] . '</p></div>';
			unset( $_SESSION[$this->msg_var] );
			unset( $_SESSION[$this->msg_class_var] );
		}
	}
}

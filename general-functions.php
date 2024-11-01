<?php

function video_download_encode( $string ) {
    if( ! defined( 'VIDEO_ENCRYPTION_KEY' ) ) die( 'Encryption Key Missing' );
    $iv = openssl_random_pseudo_bytes( 8 );
    $enc_raw = openssl_encrypt( $string, 'blowfish', hex2bin( VIDEO_ENCRYPTION_KEY ), OPENSSL_RAW_DATA, $iv );
    return str_replace( '+', '-', base64_encode( $iv . $enc_raw ) );
}

function video_download_decode( $string ) {
    if( ! defined( 'VIDEO_ENCRYPTION_KEY' ) ) die( 'Encryption Key Missing' );
    $string = base64_decode( str_replace( '-', '+', $string ) );
    $dec_iv = substr( $string, 0, 8 );
    $dec_data = substr( $string, 8 );
    return openssl_decrypt( $dec_data, 'blowfish', hex2bin( VIDEO_ENCRYPTION_KEY ), OPENSSL_RAW_DATA, $dec_iv );
}

function video_the_excerpt( $charlength ){
	$excerpt = get_the_excerpt();
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}

function video_file_size( $bytes ){
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem){
        if($bytes >= $arItem["VALUE"]){
            $result = $bytes / $arItem["VALUE"];
            $result = strval(round($result, 2))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

function video_limit_text( $text, $charlength ){
	$charlength++;
	if ( mb_strlen( $text ) > $charlength ) {
		$subex = mb_substr( $text, 0, $charlength - 2 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '..';
	} else {
		echo $text;
	}
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( !is_search() ) {
			echo '<li><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
		}else{
			echo '<li><a href="' . esc_url( $crumb[1] ) . '" style="font-size: 18px; color: #000000;">' . esc_html( $crumb[0] ) . '</a></li>';
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo $delimiter;
		}
	}

	echo $wrap_after;

}
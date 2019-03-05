<?php

// Удалю ненужные статусы из заказа
add_filter( 'wc_order_statuses', 'ravens_remove_processing_status' );

// Добавляю статус Передано курьеру в заказы
add_filter( 'wc_order_statuses', 'ravens_add_order_statuses' );
add_action( 'init', 'register_ravens_order_status' );

function ravens_remove_processing_status( $statuses )
{
    if( isset( $statuses['wc-failed'] ) ){
        unset( $statuses['wc-failed'] );
    }

    if( isset( $statuses['wc-pending'] ) ){
        unset( $statuses['wc-pending'] );
    }

    if( isset( $statuses['wc-on-hold'] ) ){
        unset( $statuses['wc-on-hold'] );
    }
    return $statuses;
}

function ravens_add_order_statuses( $order_statuses ) 
{
    $new_order_statuses = array();

    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-awaiting-shipment'] = 'Передано курьеру';
        }
    }
    return $new_order_statuses;
}

// ФОормирую новый статус заказа
function register_ravens_order_status() 
{
    register_post_status( 'wc-awaiting-shipment', array(
        'label'                     => __('Передано курьеру', '7-ravens'),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Передано курьеру <span class="count">(%s)</span>', 'Передано курьеру <span class="count">(%s)</span>' )
    ) );
}

<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class TWGM_Route_Table extends WP_List_Table {
	    
    function __construct() {	
        global $status, $page;
        parent::__construct( array(
            'singular'      => 'Route',
            'plural'        => 'Routes',
            'ajax'          => false
        ));
    }

    function column_default( $item, $column_name ) {        
        return esc_html( $item[ $column_name ] );
    }


	function column_cb( $item ) {
        return sprintf( '<input type="checkbox" name="id[]" value="%s" />', absint( $item['id'] ) );
    }
    
    function column_name( $item ) {
        $page = 'route';
        $table_page = 'twgm-' . $page . '-table';
        $add_page = 'twgm-' . $page . '-add';
        $admin_url = admin_url( sprintf( 'admin.php?page=' . $table_page . '&action=sdel&id=%s', absint( $item['id'] ) ) );
        $actions = array(
            'edit' => sprintf( '<a href="?page=' . $add_page . '&id=%s">%s</a>', absint( $item['id'] ), __('Edit', 'twgm' ) ), 
            'sdel' => '<a href="' . wp_nonce_url( $admin_url, 'twgm_' . $page . '_del_' . absint( $item['id'] ), 'twgm_tnonce' ) . '">Delete</a>',
        );
        return sprintf( '%s %s', $item['name'], $this->row_actions( $actions ) );
    }
	
    function column_spname( $item ) {
        return $item['spname'];
    }


    function column_epname( $item ) {
        return $item['epname'];
    }

    function get_columns() {        
		$columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'name' => __( 'Name', 'twgm' ),
            'spname' => __( 'Start Point', 'twgm' ),
            'epname' => __( 'End Point', 'twgm' )
        );
		return $columns;
	}

    function get_sortable_columns() {		
		$sortable_columns = array(
            'name' 		=> array( 'name', true ),
            'address' 	=> array( 'address', false ),
            'spname' => array( 'spname', false ),
            'epname'  => array( 'epname', false)
        );
		return $sortable_columns;
	}

    function get_bulk_actions() {        
        $actions = array(
            'bdel' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() { }

    function prepare_items() {        
		global $wpdb;
		$table_name = $wpdb->prefix . 'twgm_route'; 
        $table_marker = $wpdb->prefix . 'twgm_marker';
        $per_page 	= $this->get_items_per_page( 'routes_per_page', 20 );//5; 
        $columns 	= $this->get_columns();
		$hidden 	= array();        
		$sortable 	= $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        //$this->_column_headers = array( $columns, $hidden, $sortable );
        $this->_column_headers = $this->get_column_info();

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // prepare query params, as usual current page, order by and order direction
        $paged 		= ( isset( $_REQUEST['paged'] ) ) ? max( 0, intval( $_REQUEST['paged'] ) - 1 ) : 0;
        $orderby 	= ( isset( $_REQUEST['orderby'] ) && in_array( $_REQUEST['orderby'], array_keys( $this->get_sortable_columns() ) ) ) ? $_REQUEST['orderby'] : 'name';
        $order 		= ( isset( $_REQUEST['order'] ) && in_array( $_REQUEST['order'], array('asc', 'desc') ) ) ? $_REQUEST['order'] : 'asc';

		$offset = $paged * $per_page;
        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        if( isset( $_REQUEST['s'] ) ) {
			$search = $_REQUEST['s'];
			$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT $table_name.*, m1.name as spname, m2.name as epname FROM $table_name LEFT JOIN $table_marker as m1 ON $table_name.startpoint = m1.id LEFT JOIN $table_marker as m2 ON $table_name.endpoint = m2.id WHERE $table_name.name LIKE '%%%s%%' ORDER BY $orderby $order LIMIT %d, %d", $search, $offset, $per_page), ARRAY_A );
			$total_items = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM $table_name WHERE name LIKE '%%%s%%'", $search ) );
		} else {
            $this->items = $wpdb->get_results( $wpdb->prepare( "SELECT $table_name.*, m1.name as spname, m2.name as epname FROM $table_name LEFT JOIN $table_marker as m1 ON $table_name.startpoint = m1.id LEFT JOIN $table_marker as m2 ON $table_name.endpoint = m2.id ORDER BY $orderby $order LIMIT %d, %d", $offset, $per_page ), ARRAY_A );
			$total_items = $wpdb->get_var( "SELECT COUNT(id) FROM $table_name" );
		}
		
        // [REQUIRED] configure pagination
        $this->set_pagination_args( array(
            'total_items' 	=> $total_items, // total items defined above
            'per_page' 		=> $per_page, // per page constant defined at top of method
            'total_pages' 	=> ceil( $total_items / $per_page ) // calculate pages count
        ));
    }
	
}
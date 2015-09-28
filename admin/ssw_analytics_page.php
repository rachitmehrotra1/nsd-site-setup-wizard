<?php

    global $wpdb;
    $ssw_main_table = $this->ssw_main_table();
    $options = $this->ssw_fetch_config_options();
        $is_debug_mode = $options['debug_mode'];    

	echo '<h3>Site Setup Wizard Analytics</h3>';

	echo '<p>This page will be having all the available reports from the Site Setup Wizard Plugin</p>';

    /* Fetch count of all sites created so far using Site Setup Wizard based on their cateogory selected */
    $results = $wpdb->get_results( 
        'SELECT site_usage, count(*) as number_of_sites FROM '.$ssw_main_table.' WHERE site_created = 1 group by site_usage'
    );
    $this->ssw_sql_log($wpdb->last_error);

    echo '<h4>Number of Sites created using Site Setup Wizard</h4>';
    echo '<p>';
        foreach( $results as $obj ) {
            $site_usage = $obj->site_usage;
            $number_of_sites = $obj->number_of_sites;
            echo $site_usage.' - '.$number_of_sites.'<br/>';
        }
    echo '</p>';

    /* Fetch count of all sites created and all steps of wizard completed so far using Site Setup Wizard based on their cateogory selected */
    $results2 = $wpdb->get_results( 
        'SELECT site_usage, count(*) as number_of_sites FROM '.$ssw_main_table.' WHERE wizard_completed = 1 group by site_usage'
    );
    $this->ssw_sql_log($wpdb->last_error);

    echo '<h4>Number of Sites created using Site Setup Wizard and all steps of wizard were completed</h4>';
    echo '<p>';
        foreach( $results2 as $obj ) {
            $site_usage = $obj->site_usage;
            $number_of_sites = $obj->number_of_sites;
            echo $site_usage.' - '.$number_of_sites.'<br/>';
        }
    echo '</p>';

    /* Debug Code */
        if( $is_debug_mode == true ) {
            echo '<br/>Debug Mode is ON';
            echo '<br/>Results Query 1 = ';
            print_r($results);
            echo '<br/>Results Query 2 = ';
            print_r($results2);
        }

?>
<?php 


    function addNewNotify( $dataPost, $msg ) {

        $table = "notifikasi";
        
        // notifikasi
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'f94c640978d3a129165b',
            '39bfdc68c91f0dc49e69',
            '1214854',
        $options
        );
        
        $data['message'] = $msg;
        $pusher->trigger('my-channel', 'my-event', $data);



        $ci=& get_instance();
        $ci->load->database(); 


        $ci->db->insert( $table, $dataPost );
    }




    function getNotify( $where = null ) {
        $ci=& get_instance();
        $table = "notifikasi";

        $ci->load->database(); 

        if ( $where ) {

            $query = $ci->db->get_where( $table, $where );
        } else {

            $query = $ci->db->get( $table );
        }

        $output = [

            'status'    => $query->num_rows() > 0 ? true : false, 
            'data'      => $query->result_array()
        ];

        // echo json_encode($output, JSON_PRETTY_PRINT);

        
    }






    function drawNotify( $where = null ) {


        $ci=& get_instance();
        $table = "notifikasi";
        $ci->load->database(); 

        $ci->db->order_by('dibuat_pada', 'DESC');
        if ( $where ) {

            $query = $ci->db->get_where( $table, $where );
        } else {

            $query = $ci->db->get( $table );
        }

        if ( $query->num_rows() > 0 ) {

            $list = "";
            foreach ( $query->result_array() AS $row ) {

                $list .= '<div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-40 symbol-light-primary mr-5">
                                <span class="symbol-label">
                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="'.$row['url'].'" class="text-dark text-hover-primary mb-1 font-size-lg">'.$row['nama'].'</a>
                                <span class="text-muted">'.date('d F Y H.i A', strtotime( $row['dibuat_pada'] )).'</span>
                                <small>'.$row['notes'].'</small>
                            </div>
                            <!--end::Text-->
                        </div>';
            }

        } else {

            $list = '<div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!
            <br />No new notifications.</div>';
        }

        
        


        // cek notif
        $action = '';
        if ( $query->num_rows() > 0 ) {

            $uri = $ci->uri->segment(1);
            $action .= '<!--begin::Action-->
            <div class="d-flex flex-center pt-7">
                <a href="'.base_url('adminclient/confirmAllNotification?page='. $uri).'" class="btn btn-light-primary font-weight-bold text-center">Tandai Sudah Dibaca</a>
            </div>
            <!--end::Action-->';
        }

        $html = '<!--begin::Scroll-->
        <div id="notify-draw" class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
            '.$list.'
        </div>
        <!--end::Scroll-->
        <!--begin::Action-->
        '.$action.'
        <!--end::Action-->';


        $output = preg_replace("/\s+|\n+|\r/", ' ', $html);
        echo $output;
    }
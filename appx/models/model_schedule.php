<?php

    class Model_schedule extends CI_Model {
    
        function getSchedulesByUser( $userID ) {
            $this->db->where( "createdBy", $userID );
            $this->db->where( "substr(scheduledAt,1,10)", date("Y-m-d") );
            $this->db->where( "isActive", true );
            $this->db->order_by("scheduledAt", "asc");
            $query = $this->db->get( "tbl_schedule" );

            return $query;
        }

        function updateSchedule( $schedule ) {
            $isUpdated = $this->db->update( "tbl_schedule", array( "description" => $schedule["description"] ), array( "ID" => $schedule["schedID"] ) );
            return $this->db->last_query();
        }

        // REST
        public function getAllSchedules(){  
            $this->db->select("ID, scheduledAt, description, createdAt, createdBy, isActive");
            $this->db->from("tbl_schedule");
            $this->db->order_by("scheduledAt", "asc"); 
            $query = $this->db->get();

            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return 0;
            }
        }
    
    }

?>
<?php

class sqldata {
    
    public $sql_query;
    
    public function get_sql_data() //už nepoužívať - nové: get_sql_table_data
    {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($con,"SET NAMES 'utf8'");
        $data = mysqli_fetch_all(mysqli_query($con,  $this -> sql_query), MYSQLI_ASSOC);
        return $data;
        //Dorobiť return one figure, one line
    }

    public function chceck_sql_connection()
    {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($con,"SET NAMES 'utf8'");
        if (mysqli_connect_errno())
            {
                return "Failed to connect to MySQL: " . mysqli_connect_error();
            } 
            
            else
            { 
                return "Spojenie s MySQL OK";
            }

    }


    public function get_sql_table_data() 
    {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($con,"SET NAMES 'utf8'");
        $data = mysqli_fetch_all(mysqli_query($con,  $this -> sql_query), MYSQLI_ASSOC);
        //Vráti 2D array
        return $data;
    }


    public function get_sql_row_data() 
    {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($con,"SET NAMES 'utf8'");
        $data = mysqli_fetch_all(mysqli_query($con,  $this -> sql_query), MYSQLI_ASSOC);

        foreach($data  as &$row):

            $rowline = $row;
    
        endforeach;

        //Vráti 1D array ale value
        return $rowline;
    }

    public function get_sql_onefigure_data($fieldname) 
    {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($con,"SET NAMES 'utf8'");
        $data = mysqli_fetch_all(mysqli_query($con,  $this -> sql_query), MYSQLI_ASSOC);

        foreach($data  as &$row):

            $figure = $row["$fieldname"];
    
        endforeach;

        //Vráti iba jednu položku (používať keď sa zisťuje jedna vec - min, max, priemer atd)
        if (isset($figure)) {return $figure;} else {return 0;}
    }



    public function save_sql_data() 
    {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($con,"SET NAMES 'utf8'");
        if ($con->query($this -> sql_query) === TRUE)
            {
                //echo "New record created successfully";
                return TRUE;
            }
        
        else
            {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                //return FALSE;
            }
        
        //$con->close();
        return $con->error;
        $con->close();

        //Dorobiť
        // Escape user inputs for security
        //$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
        //$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
        //$email = mysqli_real_escape_string($link, $_REQUEST['email']);

    }

}

?>

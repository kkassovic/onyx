<?php
// PHP class file - display and visual classes
// PURE CSS form control class

// Render function
function renderLayout2($view_content_file, $view_template_file, $app_layout_file, $variables = array())
    {
        //$contentFileFullPath = TEMPLATES_PATH . "/" . $contentFile;
        //$contentFileFullPath = "" . $contentFile;
     
        // making sure passed in variables are in scope of the template
        // each key in the $variables array will become a variable
        if (count($variables) > 0)
            {
                foreach ($variables as $key => $value)
                    {
                        if (strlen($key) > 0) {${$key} = $value;}
                    }
            }
        //Template render
        include ($app_layout_file);
    
    }


class bs4_form_control {
    public $label;
    public $name;
    public $type;
    public $placeholder;
    public $required;
    public $size = 30;
    public $dd_value = array(); //array
    public $dd_display = array(); //array
    public $help_block;
    public $select_value;
    public $readonly;
    public $input_value;
    public $form_id;
    public $checked;

    //  Pure CSS Aligned Form




    public function show_texta() //zle - pozri nižšie pure css text area
    {
        $ta = "<div class=\"form-group\">";
        $ta .= "<label>" . $this -> label . "</label>";
        $ta .= "<textarea class=\"form-control\" rows=\"3\" value=\"" . $this -> dd_value[0] . "\" name=\"" . $this -> name . "\"></textarea>";
        $ta .= "<small class=\"form-text text-muted\">" . $this -> help_block . "</small>\n";
        $ta .= "</div>";
        return $ta;
    }

    public function show_submit() 
    {
        $ta = "<img id=\"prog_img\" src=\"/img/progress2.gif\" alt=\"Pracujeme na tom\" style=\"width:128px;height:15px;visibility: hidden;\"><br>";
        $ta .= "<p id=\"demo\"></p><br>";
        $ta .= "<button id=\"button1\" type=\"submit\" class=\"pure-button pure-button-primary\" onclick=\"process_form()\">Zaznamenať</button>";
        return $ta;
    }

    public function show_input()
    {
        if ($this -> required == true) { $req = " required ";}
        if ($this -> readonly == true) { $ro = " readonly ";}

        $in = "\n<div class=\"form-group\">\n";
        $in .= "<label>" . $this -> label . "</label>\n";
        $in .= "<input " . $ro .  "class=\"form-control\"" . " name =\"" . $this -> name . "\" type=\"" . $this -> type . "\" value=\"" . $this -> input_value . "\" placeholder= \"" . $this -> placeholder  . "\"" . $req . ">\n";
        $in .= "<small class=\"form-text text-muted\">" . $this -> help_block . "</small>\n";
        $in .= "</div>\n";
        return $in;
    }



    public function show_drop() 
    {
        //print_r($this -> dd_value);
        //echo "<br><br>";
        //echo $meno[10] . "<br>";
        //echo "<br><br>";

        if ($this -> required == true) { $req = "required";}
        
        //$mail->SMTPAuth = true;
        
        $drop = "<div class=\"form-group\">\n";
        $drop .= "<label>" . $this -> label . "</label>\n";
        $drop .= "<select class=\"form-control\" name=" . $this -> name . " " . $req . ">\n";
        $drop .= "<option size =" . $this -> size . ">\n";
        $pocet = count($this -> dd_value) -1;
        $optsel ="";
        for ($x = 0; $x <= $pocet; $x++) {
            if ($this -> select_value == $this -> dd_value[$x]) { $optsel = "selected";}
            $drop .= "<option value='". $this -> dd_value[$x] . "'" . $optsel . ">". $this -> dd_display[$x] . "</option>\n";
            $optsel = "";
        }
        $drop .= "</select>";
        $drop .= "<small class=\"form-text text-muted\">" . $this -> help_block . "</small>\n";
        $drop .= "</div>";

        return $drop;
    }

    public function show_datalist() 
    {
 
        if ($this -> required == true) { $req = "required";}
        
        $drop = "<div class=\"form-group\">\n";
        $drop .= "<label>" . $this -> label . "</label>\n";
        $drop .= "<input list=\"zoznam\" class=\"custom-select\" name=" . $this -> name . " " . $req . ">\n";
        $drop .= "<datalist id=\"zoznam\">";
        $drop .= "<option size =" . $this -> size . ">\n";
        $pocet = count($this -> dd_value) -1;
        $optsel ="";
        for ($x = 0; $x <= $pocet; $x++) {
            if ($this -> select_value == $this -> dd_value[$x]) { $optsel = "selected";}
            $drop .= "<option value='". $this -> dd_value[$x] . "'" . $optsel . ">". $this -> dd_display[$x] . "</option>\n";
            $optsel = "";
        }
        $drop .= "</datalist>";
        $drop .= "<small class=\"form-text text-muted\">" . $this -> help_block . "</small>\n";
        $drop .= "</div>";

        return $drop;
    }




}
 class kms_icons {
     public $icon_size;
     public $icon_color;
     public $icon_selector;

     public function display_icon() 
     {
        $ta = "<i class=\"material-icons " . $this -> icon_color . "\">" . $this -> icon_selector . "</i>";
        return $ta;
     }

 }

 class kms_table {
    public $css_class;
    public $table_id;
    public $column_names = array(); //array
    public $table_data = array(); //array
    public $no_table_page;
    public $no_export;
    public $order_col;
    public $order_type;
    public $is_datatable;
    
    public function show_table() 
    {
        //print_r($this -> table_data);
        //echo "<br><br>";
        //echo $meno[10] . "<br>";
        //echo "<br><br>";

        //if ($this -> required == true) { $req = "required";}
        if ($this -> no_table_page == TRUE) { $pg = "false";} else { $pg = "true";}
        if ($this -> no_export == TRUE) { $exp = " ";}
             else { 
                    $exp = "\"dom\": 'Blfrtip'
                    , \"buttons\": [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],";
                  }

        if (!isset($this -> order_col)) { $def_ord = "0";} else { $def_ord = $this -> order_col;}
        if (!isset($this -> order_type)) { $def_ord_type = "desc";} else { $def_ord_type = $this -> order_type;}
        
        $table = "<table id=\"" . $this -> table_id . "\" " . "class=\"" . $this -> css_class . "\">\n";
        $table .= "<thead>\n";
        $table .= "<tr>\n";
        foreach( $this -> column_names as $col ):
            $table .= "<th>" . $col . "</th>\n";
         endforeach;
        $table .= "</tr>\n";
        $table .= "</thead>\n";
        
        $table .= "<tbody>\n";
        foreach( $this -> table_data as $row ):
            $table .= "<tr>\n";
            foreach( $row as $col ):
                $table .= "<td>" . $col . "</td>\n";
            endforeach;  
            $table .= "</tr>\n"; 
        endforeach;
        
        $table .= "<tbody>\n";
        $table .= "</table>\n";
        
        return $table;
    }

}

class kms_simple_table {
    public $css_class;
    public $table_id;
    public $column_names = array(); //array
    public $table_data = array(); //array

    
    public function show_table() 
    {

        $table = "<table id=\"" . $this -> table_id . "\" " . "class=\"" . $this -> css_class . "\">\n";
        $table .= "<thead>\n";
        $table .= "<tr>\n";
        foreach( $this -> column_names as $col ):
            $table .= "<th>" . $col . "</th>\n";
         endforeach;
        $table .= "</tr>\n";
        $table .= "</thead>\n";
        
        $table .= "<tbody>\n";
        foreach( $this -> table_data as $row ):
            $table .= "<tr>\n";
            foreach( $row as $col ):
                $table .= "<td>" . $col . "</td>\n";
            endforeach;  
            $table .= "</tr>\n"; 
        endforeach;
        
        $table .= "<tbody>\n";
        $table .= "</table>\n";
        
        return $table;
    }

}


//Používa sa na modifikáciu dátumového poľa aby fungovalo tridenie v data tables
function datemodif ($tablearray, $datecolumn)
{
    foreach ($tablearray as &$record):
        
        $record["$datecolumn"] = "<span style=\"display:none;\">" . date_format(date_create($record["$datecolumn"]), "YMd") . "</span>" . date_format(date_create($record["$datecolumn"]), "d-M-Y");
    
    endforeach;

    return $tablearray;

}


//Použiť keď sa z DB zisťuje iba jeden výsledok, napr. súčet, min max a podobne NEPOUZIVAT je v model_classes
function onefigure ($rowarray, $fieldname)
{
    foreach($rowarray  as &$row):

        $figure = $row["$fieldname"];

    endforeach;

    //Vráti nie array ale value
    return $figure;

}


//Použiť keď sa z DB zisťuje iba jeden riadok NEPOUZIVAT je v model_classes
function oneline ($rowarray)
{
    foreach($rowarray  as &$row):

        $rowline = $row;

    endforeach;

    //Vráti nie array ale value
    return $rowline;

}


//Pridá do tablukového 2d pola ďalší stĺpec (additinal = array)
function addaction ($tablearray, $additional)
{
    $i = 0;
    foreach ($tablearray as &$record):
        
        $record["action"] = $additional[$i];
        $i = $i + 1;

    endforeach;

    return $tablearray;

}

//Pridá do tablukového 2d pola ďalší stĺpec (additinal = value)
function addxaction ($tablearray, $additional)
{
    foreach ($tablearray as &$record):
        
        $record["action"] = $additional;
   
    endforeach;

    return $tablearray;

}

//Pridá do 2D poľa ďalší stĺpec - ale je srkytý
function addhiddenfield ($tablearray, $field)
{
    foreach ($tablearray as &$record):
        
        $record["index"] = "<input type=\"hidden\" name=\"index[]\" value=\"" . $record["$field"] . "\"/>";
        
   
    endforeach;

    return $tablearray;

}


//Vyrobí hyperlink
class hyperlink
{
    public $link;
    public $target;
    public $text;

    public function makehyperlink ()
    {
        if (!empty($this -> link))
            {
                $output = "<a href=\"https://" . $this -> link . "\" target=\"" . $this -> target . "\">" . $this -> text . "</a>";
            }
        
        return $output;
    }
}

class bs4_topnav {
    public $navarray = array(); //array;

    
    public function show_topnav() 
    { 
        $navbar = "<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">\n";
        $navbar .= "<ul class=\"navbar-nav ml-auto mt-2 mt-lg-0\">\n";

        foreach( $this -> navarray as $item ):
                $navbar .= "<li class=\"nav-item active\">\n";
                $navbar .= "<a class=\"nav-link\" href=\"" . $item["ref"] . "\">" . $item["disp"] . " <span class=\"sr-only\">(current)</span></a>\n";
                $navbar .= "</li>\n";                
        endforeach;
        
        $navbar .= "</li>\n";
        $navbar .= "</ul>\n";
        $navbar .= "</div>\n";

        return $navbar;
    }


}




class purecss_topnav {
    public $navarray = array(); //array;

    
    public function show_topnav() 
    { 
        $navbar = "<div class=\"pure-menu pure-menu-horizontal\">\n";
        $navbar .= "<a href=\"#\" class=\"pure-menu-heading pure-menu-link\">BRAND</a>\n";
        $navbar .= "<ul class=\"pure-menu-list\">\n";

        //<li class="pure-menu-item"><a href="#" class="pure-menu-link">News</a></li>

        foreach( $this -> navarray as $item ):
                
                $navbar .= "<li class=\"pure-menu-item\"><a href=\"" . $item["ref"] . "class=\"pure-menu-link\">" . $item["disp"] . "</a>\n";
                               
        endforeach;
        
        $navbar .= "</ul>\n";
        $navbar .= "</div>\n";

        return $navbar;
    }


}



//Vytvorí pole (stĺpec) s variabilným linkom -> ID zvyčajne 
class actionlink {
    public $point_id = array(); //array;
    public $reference;
    public $requestfield;
    public $linktext;

    public function make_link() 
    { 
        $i = 0;
        foreach( $this -> point_id as $id ):
                $link[$i] = "<a href=\"";
                $link[$i] .= $this -> reference . $this -> requestfield . "=" . $id . "\"";
                $link[$i] .= ">" . $this -> linktext . "</a>";
                $i++;
                //<a href="zaznam_zmluva_replicate_temp.php?id=1222">Upraviť</a>

        endforeach;

        return $link;
    }


}


//Vytvorí stĺpec s checkboxom
class checkboxarray {
    public $value = array(); //array;
    public $name;
    public $disp_text = array(); //array;

    public function make_check_arr() 
    { 
        $i = 0;
        foreach( $this -> value as $val ):
                $link[$i] = "<input type=\"checkbox\" id=\"stacked-remember\" value =\"";
                $link[$i] .= $val . "\"" . " name = \"" . $this -> name . "\"/>" .  $this -> disp_text[$i] . "</label>";
                $i++;
                //<a href="zaznam_zmluva_replicate_temp.php?id=1222">Upraviť</a>

        endforeach;

        return $link;
    }


}



//Pure CSS action button - dropdown
class purecss_actbutton {
    public $buttonarray = array(); //array;
    public $point_id = array(); //array;
    public $requestfield;
    public $target_index;

    
    public function show_action_drop() 
    { 
        $i = 0;
        foreach( $this -> point_id as $id ):

            $actbutton[$i] = "<div class=\"pure-menu pure-menu-horizontal\">\n";
            $actbutton[$i] .= "<ul class=\"pure-menu-list\">\n";
            $actbutton[$i] .= "<li class=\"pure-menu-item pure-menu-has-children pure-menu-allow-hover\">\n";
            $actbutton[$i] .= "<a href=\"#\" id=\"menuLink1\" class=\"pure-menu-link\">Akcia</a>\n";
            $actbutton[$i] .= "<ul class=\"pure-menu-children\">\n";

            foreach( $this -> buttonarray as $item ):
                    $actbutton[$i] .= "<li class=\"pure-menu-item\">\n";
                    $actbutton[$i] .= "<a href=\"";
                    $actbutton[$i] .= $item["ref"] . $this -> requestfield . "=" . $id . "\"";
                    $actbutton[$i] .= " class=\"pure-menu-link\">" . $item["disp"] . "</a>\n";
                    //$actbutton[$i] .= "<a href=\"" . $item["ref"] . "\"class=\"pure-menu-link\">" . $item["disp"] . "</a>\n";
                    $actbutton[$i] .= "</li>\n";

            endforeach;
            
            $actbutton[$i] .= "</ul>\n";
            $actbutton[$i] .= "</li>\n";
            $actbutton[$i] .= "</ul>\n";
            $actbutton[$i] .= "</div>\n";
            $i++;
        
        endforeach;

        return $actbutton;
    }

    public function show_action_drop_single() 
    { 


            $actbutton = "<div class=\"pure-menu pure-menu-horizontal\">\n";
            $actbutton .= "<ul class=\"pure-menu-list\">\n";
            $actbutton .= "<li class=\"pure-menu-item pure-menu-has-children pure-menu-allow-hover\">\n";
            $actbutton .= "<a href=\"#\" id=\"menuLink1\" class=\"pure-menu-link\">Akcia</a>\n";
            $actbutton .= "<ul class=\"pure-menu-children\">\n";

            foreach( $this -> buttonarray as $item ):
                    $actbutton .= "<li class=\"pure-menu-item\">\n";
                    $actbutton .= "<a href=\"";
                    $actbutton .= $item["ref"] . $this -> requestfield . "=" . $this -> target_index . "\"";
                    $actbutton .= " class=\"pure-menu-link\">" . $item["disp"] . "</a>\n";
                    //$actbutton[$i] .= "<a href=\"" . $item["ref"] . "\"class=\"pure-menu-link\">" . $item["disp"] . "</a>\n";
                    $actbutton .= "</li>\n";

            endforeach;
            
            $actbutton .= "</ul>\n";
            $actbutton .= "</li>\n";
            $actbutton .= "</ul>\n";
            $actbutton .= "</div>\n";

        


        return $actbutton;
    }


}


// PURE CSS form control class

class purecss_form_control {
    public $label;
    public $name;
    public $type;
    public $placeholder;
    public $required;
    public $size = 30;
    public $dd_value = array(); //array
    public $dd_display = array(); //array
    public $help_block;
    public $select_value;
    public $readonly;
    public $input_value;
    public $checked;
    public $step;

    //  Pure CSS Aligned Form



    public function show_texta() 
    {
        if ($this -> required == true) { $req = " required ";}
        if ($this -> readonly == true) { $ro = " readonly ";}

        $ta = "<div class=\"pure-control-group\">\n";
        $ta .= "<label>" . $this -> label . "</label>\n";
        $ta .= "<textarea " . $req . "class=\"pure-input-1-2\" rows=\"2\"" . "\" name=\"" . $this -> name . "\">" . $this -> input_value . "</textarea>\n";
        $ta .= "<p class=\"pure-form-message-inline\">" . $this -> help_block . "</p>\n";
        $ta .= "</div>\n";
        return $ta;
    }


    public function show_input()
    {
        if ($this -> required == true) { $req = " required ";}
        if ($this -> readonly == true) { $ro = " readonly ";}

        $in = "\n<div class=\"pure-control-group\">\n";
        $in .= "<label>" . $this -> label . "</label>\n";
        $in .= "<input" . $ro . " " . $req . " step =\"" . $this -> step . "\" name =\"" . $this -> name . "\" type=\"" . $this -> type . "\" value=\"" . $this -> input_value . "\" placeholder= \"" . $this -> placeholder  . "\">\n";
        $in .= "<span class=\"pure-form-message-inline\">" . $this -> help_block . "</span>\n";
        $in .= "</div>\n";
        return $in;
    }


    public function show_checkbox()
    {
        if ($this -> required == true) { $req = " required ";}
        if ($this -> readonly == true) { $ro = " readonly ";}
        if ($this -> checked == true) { $ch = " checked ";}

        $in = "\n<div class=\"pure-controls\">\n";
        $in .= "\n<label for=\"aligned-cb\" class=\"pure-checkbox\">\n";
        $in .= "<input type = \"checkbox\" " . $ro . " " . $ch . " " . $req . " name =\"" . $this -> name . "\" value=\"" . $this -> input_value . "\"> " .$this -> label . "\n";
        $in .= "</label>\n";
        //<label><input type="checkbox" name="checkbox" value="value">Text</label>
        $in .= "</div>\n";
        return $in;
    }




    //Dorobiť
    public function show_drop() 
    {
        //print_r($this -> dd_value);
        //echo "<br><br>";
        //echo $meno[10] . "<br>";
        //echo "<br><br>";

        if ($this -> required == true) { $req = "required";}
        
        //$mail->SMTPAuth = true;
        
        $drop = "<div class=\"pure-control-group\">\n";
        $drop .= "<label>" . $this -> label . "</label>\n";
        $drop .= "<select " . $this -> event . " name=" . $this -> name . " id=" . "'" . $this -> id . "'". $req . ">\n";
        $drop .= "<option size =" . $this -> size . ">\n";
        $pocet = count($this -> dd_value) -1;
        $optsel ="";
        for ($x = 0; $x <= $pocet; $x++) {
            if ($this -> select_value == $this -> dd_value[$x]) { $optsel = "selected";}
            $drop .= "<option value='". $this -> dd_value[$x] . "'" . $optsel . ">". $this -> dd_display[$x] . "</option>\n";
            $optsel = "";
        }
        $drop .= "</select>";
        $drop .= "<p class=\"pure-form-message-inline\">" . $this -> help_block . "</p>\n";
        $drop .= "</div>";

        return $drop;
    }

}

?>
